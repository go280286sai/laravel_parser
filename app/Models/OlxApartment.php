<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OlxApartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'url', 'rooms', 'floor', 'etajnost', 'price', 'description',
        'status', 'comment', 'location', 'type'];

    /**
     * @param array $fields
     * @return void
     */
    public static function add(array $fields): void
    {
        $object = new self();
        $object->fill($fields);
        $object->date=$object->getDateNew($fields['date']);
        $object->save();
    }

    /**
     * @return void
     */
    public static function cleanBase(): void
    {
        self::truncate();
    }

    /**
     * @param int $id
     * @return void
     */
    public static function removeId(int $id): void
    {
        $object = self::find($id);
        $object->delete();
        $object->save();
    }

    /**
     * @param array $fields
     * @return void
     */
    public static function removeSelect(array $fields): void
    {
        foreach ($fields as $item) {
            self::removeId($item);
        }
    }

    /**
     * @param int $id
     * @param string $comment
     * @return void
     */
    public static function addComment(int $id, string $comment): void
    {
        $object = self::find($id);
        $object->comment = $comment;
        $object->save();
    }

    /**
     * @param $field
     * @return string|void
     */
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
                '12' => 'грудня'
            ];
            foreach ($month as $item => $value) {
                if ($param[1] == $value) {
                    return Carbon::createFromFormat('d m Y', $param[0] . ' ' . $item . ' ' . $param[2])->format('Y-m-d');
                }
            }
        }
    }

    /**
     * @param array $fields
     * @return void
     */
    public static function setStatus($field): void
    {
            $object = self::find($field);
            $object->status = 1;
            $object->save();
    }

}
