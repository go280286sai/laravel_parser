<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Flysystem\File;

class Setting extends Model
{
    use HasFactory;

    /**
     * @param array $fields
     * @return void
     */
    public static function addSetting(array $fields): void
    {

        $name = (string)$fields['name'];
        if(self::find(1)==null){
            $obj = new self();
        }else{
            $obj=self::find(1);
        };
        $obj->$name = (float)$fields['text'];
        $obj->save();
    }

    /**
     * @return mixed
     */
    public static function getMAE()
    {
        $obj = self::find(1);
        return $obj->MAE;
    }
}
