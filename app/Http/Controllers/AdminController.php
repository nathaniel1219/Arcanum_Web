<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Services\MongoService;

class AdminController extends Controller
{
    protected $mongo;

    public function __construct(MongoService $mongo)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $this->mongo = $mongo;
    }

    // Show users with orders
    public function showUsers()
    {
        $users = User::with('orders')->get();
        return view('admin.users', compact('users'));
    }

    // Update order status
    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        // Log to MongoDB with proper UTCDateTime
        $this->mongo->insert('order_logs', [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'new_status' => $order->order_status,
            'updated_by' => Auth::id(),
            'updated_at' => MongoService::nowForMongo(),
        ]);

        return redirect()->back()->with('success', 'Order status updated.');
    }

    // Show form to add product
    public function addProduct()
    {
        $categories = ['TCG', 'Figures'];
        $subCategories = ['pokemon', 'Yu-Gi-Oh', 'Funko Pop'];
        $products = Product::all();
        return view('admin.add-product', compact('categories', 'subCategories', 'products'));
    }

    // Store product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string'],
            'price'        => ['nullable', 'numeric'],
            'category'     => ['required', Rule::in(['TCG','Figures'])],
            'sub_category' => ['nullable', Rule::in(['pokemon','Yu-Gi-Oh','Funko Pop'])],
            'details'      => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $imageFilename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $safeName = Str::slug(substr($request->input('product_name'), 0, 40));
            $imageFilename = time() . '_' . ($safeName ?: 'product') . '_' . uniqid() . '.' . $ext;
            $destination = public_path('images/products');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $imageFilename);
        }

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'description'  => $request->input('description'),
            'price'        => $request->input('price'),
            'category'     => $request->input('category'),
            'sub_category' => $request->input('sub_category'),
            'image_url'    => $imageFilename,
            'details'      => $request->input('details'),
        ]);

        // Log product creation to MongoDB
        $this->mongo->insert('product_logs', [
            'product_id'   => $product->id,
            'name'         => $product->product_name,
            'category'     => $product->category,
            'sub_category' => $product->sub_category,
            'price'        => $product->price,
            'created_by'   => Auth::id(),
            'created_at'   => MongoService::nowForMongo(),
        ]);

        return redirect()->route('admin.users')->with('success', 'Product added successfully.');
    }

    // Delete product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_url) {
            $path = public_path('images/products/' . $product->image_url);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        // Log deletion
        $this->mongo->insert('product_logs', [
            'product_id' => $id,
            'deleted_by' => Auth::id(),
            'deleted_at' => MongoService::nowForMongo(),
        ]);

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Show MongoDB logs (both order and product logs)
    public function showLogs()
    {
        // Fetch raw MongoDB logs
        $orderLogsRaw = $this->mongo->collection('order_logs')
            ->find([], ['sort' => ['updated_at' => -1]])
            ->toArray();

        $productLogsRaw = $this->mongo->collection('product_logs')
            ->find([], ['sort' => ['created_at' => -1]])
            ->toArray();

        // Helper function to safely parse MongoDB date fields
        $parseMongoDate = function ($field) {
            if (is_array($field)) {
                if (isset($field['$date'])) {
                    // Sometimes $date is numeric (milliseconds) or a string
                    if (is_numeric($field['$date'])) {
                        return date('Y-m-d H:i:s', $field['$date'] / 1000);
                    } elseif (is_string($field['$date'])) {
                        return date('Y-m-d H:i:s', strtotime($field['$date']));
                    }
                }
                // If the array itself contains '$date' nested further, flatten
                foreach ($field as $sub) {
                    if (is_array($sub) && isset($sub['$date'])) {
                        if (is_numeric($sub['$date'])) {
                            return date('Y-m-d H:i:s', $sub['$date'] / 1000);
                        } elseif (is_string($sub['$date'])) {
                            return date('Y-m-d H:i:s', strtotime($sub['$date']));
                        }
                    }
                }
                // Last fallback: cannot parse, return empty
                return '';
            } elseif (is_numeric($field)) {
                // Numeric timestamps (milliseconds)
                return date('Y-m-d H:i:s', $field / 1000);
            } elseif (is_string($field)) {
                // Already a string datetime
                return date('Y-m-d H:i:s', strtotime($field));
            }

            return '';
        };

        // Format order logs
        $orderLogs = array_map(function ($doc) use ($parseMongoDate) {
            $doc = json_decode(json_encode($doc), true);
            $doc['updated_at'] = $parseMongoDate($doc['updated_at'] ?? '');
            return $doc;
        }, $orderLogsRaw);

        // Format product logs
        $productLogs = array_map(function ($doc) use ($parseMongoDate) {
            $doc = json_decode(json_encode($doc), true);
            $doc['created_at'] = $parseMongoDate($doc['created_at'] ?? '');
            $doc['deleted_at'] = $parseMongoDate($doc['deleted_at'] ?? '');
            return $doc;
        }, $productLogsRaw);

        return view('admin.logs', compact('orderLogs', 'productLogs'));
    }


}
