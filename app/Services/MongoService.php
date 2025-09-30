<?php

namespace App\Services;

use MongoDB\Client as MongoClient;
use MongoDB\BSON\UTCDateTime;

class MongoService
{
    protected MongoClient $client;
    protected $database;

    public function __construct()
    {
        // Get Atlas URI from .env or fallback to local
        $uri = env('MONGO_DB_URI', 'mongodb://127.0.0.1:27017');
        
        $this->client = new MongoClient($uri);

        // Use database from .env (optional if included in URI)
        $db   = env('MONGO_DB_DATABASE', 'arcanum_admin_panel');
        $this->database = $this->client->{$db};
    }

    /**
     * Return a collection object.
     * Usage: (new MongoService())->collection('admin_actions')->insertOne([...]);
     */
    public function collection(string $name)
    {
        return $this->database->{$name};
    }

    // Return a Mongo UTCDateTime for now
    public static function nowForMongo()
    {
        return new UTCDateTime((int) (microtime(true) * 1000));
    }

    public function insert(string $collection, array $document)
    {
        return $this->collection($collection)->insertOne($document);
    }
}
