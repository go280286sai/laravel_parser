<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'url'];

    public static function add($fields): void
    {
        $data = new self();
        $data->fill($fields);
        $data->save();
    }

    public static function edit(int $id, array $fields): void
    {
        $data = self::find($id);
        $data->fill($fields);
        $data->save();
    }
}
