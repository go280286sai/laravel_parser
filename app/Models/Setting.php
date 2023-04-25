<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function addSetting(array $fields): void
    {
        $name = (string) $fields['name'];
        if (self::find(1) == null) {
            $obj = new self();
        } else {
            $obj = self::find(1);
        }
        $obj->$name = (float) $fields['text'];
        $obj->save();
    }

    public static function getMAE(): mixed
    {
        $obj = self::find(1);

        return $obj->MAE;
    }
}
