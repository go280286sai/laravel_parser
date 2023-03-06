<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];

    public static function add($fields)
    {
        $data = new self();
        $data->fill($fields);
        $data->save();
    }

    public static function edit($id, $fields)
    {
        $data = self::find($id);
        $data->fill($fields);
        $data->save();
    }
}
