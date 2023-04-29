<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    public function document(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function client(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public static function add(array $fields): void
    {
        $service = new self();
        $service->service = $fields['title'];
        $service->save();
    }

    public static function edit(array $fields, string $id): void
    {
        $service = self::find($id);
        $service->service = $fields['title'];
        $service->save();
    }

    public static function remove(string $id): void
    {
        $service = self::find($id);
        $service->delete();
    }
}
