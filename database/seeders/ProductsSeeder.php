<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = require database_path('products_data.php');

        foreach ($products as &$product) {
            $product['created_at'] = Carbon::now();
            $product['updated_at'] = Carbon::now();
        }

        DB::table('products')->insert($products);
    }
}
