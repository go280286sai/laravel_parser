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

    /**
     * @param $fields
     * @return void
     */
    public static function add($fields): void
    {
        $data = new self();
        $data->fill($fields);
        $data->save();
    }

    /**
     * @param int $id
     * @param array $fields
     * @return void
     */
    public static function edit(int $id, array $fields): void
    {
        $data = self::find($id);
        $data->fill($fields);
        $data->save();
    }
}
