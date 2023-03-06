<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class OlxApartment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'url', 'rooms', 'floor', 'etajnost', 'price', 'views', 'description',
        'status', 'comment', 'location', 'date', 'type'];
    public static function add(array $fields)
    {
        Log::info($fields);
        $object = new self();
        $object->fill($fields);
        $object->save();
    }

    public static function cleanBase()
    {
        self::truncate();
    }
}
