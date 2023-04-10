<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $fillable=['dollar', 'date'];
    public static function add($fields){
        $obj = new self();
        $obj->fill($fields);
        $obj->save();
    }

}
