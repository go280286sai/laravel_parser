<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['dollar', 'date'];

    public static function add($fields): void
    {
        $obj = new self();
        $obj->fill($fields);
        $obj->save();
    }
}
