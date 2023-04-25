<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class OlxApartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'url', 'rooms', 'floor', 'etajnost', 'price', 'description',
        'status', 'comment', 'location', 'type', 'area', 'real_price'];

    public static function add(array $fields): void
    {
        $object = new self();
        $object->fill($fields);
        if (isset($fields['date'])) {
            $object->date = $object->getDateNew($fields['date']);
        } else {
            $object->date = \Illuminate\Support\Carbon::now()->format('Y-m-d');
        }
        $object->save();
    }

    public static function edit(array $fields): void
    {
        $object = self::all()->find($fields['id']);
        $object->fill($fields);
        $object->save();
    }

    public static function cleanBase(): void
    {
        self::truncate();
    }

    public static function removeId(int $id): void
    {
        $object = self::find($id);
        $object->delete();
        $object->save();
    }

    public static function removeSelect(array $fields): void
    {
        foreach ($fields as $item) {
            self::removeId($item);
        }
    }

    public static function addFavorite(int $field): void
    {
        $obj = self::find($field);
        $obj->favorites = 1;
        $obj->save();
    }

    public static function removeFavorite(int $field): void
    {
        $obj = self::find($field);
        $obj->favorites = 0;
        $obj->save();
    }

    public static function addComment(int $id, string $comment): void
    {
        $object = self::find($id);
        $object->comment = $comment;
        $object->save();
    }

    public function getDateNew($field): string
    {
        $param = explode(' ', $field);
        if (strlen($param[0]) > 2) {
            return Carbon::now('Europe/Kyiv')->format('Y-m-d');
        } else {
            $month = [
                '1' => 'січня',
                '2' => 'лютого',
                '3' => 'березня',
                '4' => 'квітня',
                '5' => 'травня',
                '6' => 'червня',
                '7' => 'липня',
                '8' => 'серпня',
                '9' => 'вересня',
                '10' => 'жовтня',
                '11' => 'листопада',
                '12' => 'грудня',
            ];
            foreach ($month as $item => $value) {
                if ($param[1] == $value) {
                    return Carbon::createFromFormat('d m Y', $param[0].' '.$item.' '.$param[2])->format('Y-m-d');
                }
            }

            return Carbon::createFromFormat('d m Y', $param[0].' '.$item.' '.$param[2])->format('Y-m-d');
        }
    }

    public static function setStatus($field): void
    {
        $object = self::find($field);
        $object->status = 1;
        $object->save();
    }

    public static function setNewPrice(array $fields): void
    {
        $obj = self::find($fields[0]);
        $obj->real_price = $fields[1];
        $obj->save();
    }

    public static function uploadImage($name, $image): void
    {
        if ($image == null) {
            return;
        }
        Storage::delete('uploads/img/'.$image);
        $filename = $name.'.'.$image->extension();
        $image->storeAs('uploads/img/', $filename);
    }

    public static function getImage(string $name): string
    {
        return Storage::url('/uploads/img/'.$name);
    }
}
