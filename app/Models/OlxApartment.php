<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $object->repair = $object->isRepair($fields['description']);
        $object->service = $object->isService($fields['description']);
        $object->shops = $object->isShop($fields['description']);
        $object->metro = $object->isMetro($fields['description']);
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

    /**
     * @param  array  $fields
     */
    public static function setStatus($field): void
    {
        $object = self::find($field);
        $object->status = 1;
        $object->save();
    }

    public function isMetro(string $text): int
    {
        if (Str::contains(Str::lower($text), 'метро')) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isRepair(string $text): int
    {
        if (! Str::contains(Str::lower($text), 'без ремонт') && Str::contains(Str::lower($text), 'ремонт')) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isService(string $text): int
    {
        if (Str::contains(Str::lower($text), 'двер') || Str::contains(Str::lower($text), 'пластик') ||
            Str::contains(Str::lower($text), 'окна')) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isShop(string $text): int
    {
        $count = 0;
        if (Str::contains(Str::lower($text), 'магазин') || Str::contains(Str::lower($text), 'сильпо') ||
            Str::contains(Str::lower($text), 'рост') ||
            Str::contains(Str::lower($text), 'класс')) {
            $count = +1;
        }
        if (Str::contains(Str::lower($text), 'рынок')) {
            $count = +1;
        }
        if (Str::contains(Str::lower($text), 'школ')) {
            $count = +1;
        }
        if (Str::contains(Str::lower($text), 'садик')) {
            $count = +1;
        }
        if (Str::contains(Str::lower($text), 'больница') || Str::contains(Str::lower($text), 'поликлиника')) {
            $count = +1;
        }
        if (Str::contains(Str::lower($text), 'остановка') || Str::contains(Str::lower($text), 'транспорт')) {
            $count = +1;
        }

        return $count;
    }

    public static function setIdexLocation(): void
    {
        $loc = self::all()->pluck('location');
        $list = array_unique($loc->toArray());
        foreach ($list as $item => $value) {
            $obj = self::all()->where('location', '=', $value);
            foreach ($obj as $arr) {
                $arr->location_index = $item;
                $arr->save();
            }
        }
    }

    public static function setNewPrice(array $fields): void
    {
        $obj = self::find($fields[0]);
        $obj->real_price = $fields[1];
        $obj->save();
    }

    public function removeImage(): void
    {
        if ($this->image != null) {
            Storage::delete('uploads/img/'.$this->image);
        }
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
