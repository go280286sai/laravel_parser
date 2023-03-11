<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OlxApartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'url', 'rooms', 'floor', 'etajnost', 'price', 'description',
        'status', 'comment', 'location', 'date', 'type'];
    public static function add(array $fields)
    {
        $object = new self();
        $object->fill($fields);
        $object->save();
    }

    public static function cleanBase()
    {
        self::truncate();
    }

    public static function removeId(int $id)
    {
        $object = self::find($id);
        $object->delete();
        $object->save();
    }

    public static function removeSelect(array $fields)
    {
        foreach ($fields as $item){
            self::removeId($item);
        }
    }
    public static function addComment(int $id, string $comment)
    {
        $object = self::find($id);
        $object->comment = $comment;
        $object->save();
    }
}
