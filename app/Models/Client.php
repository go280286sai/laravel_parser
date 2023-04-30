<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'birthday',
        'gender_id',
        'phone',
        'description',
        'surname',
    ];

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return  $this->belongsTo(Service::class);
    }

    /**
     * @return HasMany
     */
    public function olx_apartment(): HasMany
    {
        return $this->hasMany(OlxApartment::class);
    }

    /**
     * @return HasMany
     */
    public function document(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Add comment to client
     */
    public static function client_comment_add(array $fields): void
    {
        $object = self::find($fields['id']);
        $object->comment = $fields['comment'];
        $object->save();
    }

    /**
     * @param array $fields
     * @return void
     */
    public static function add(array $fields): void
    {
        $object = new self();
        $object->fill($fields);
        $object->save();
    }

    /**
     * @param array $fields
     * @param string $id
     * @return void
     */
    public static function edit(array $fields, string $id): void
    {
        $object = self::find($id);
        $object->fill($fields);
        $object->save();
    }

    /**
     * @param string $id
     * @return void
     */
    public static function remove(string $id): void
    {
        $object = self::find($id);
        $object->delete();
    }
}
