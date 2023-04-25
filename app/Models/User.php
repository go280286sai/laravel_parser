<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthday',
        'gender_id',
        'description',
    ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function setToken(string $field): void
    {
        $obj = self::find(Auth::user()->id);
        $obj->token = $field;
        $obj->save();
    }

    public static function add_comment_user(array $fields): void
    {
        $object = self::find($fields['id']);
        $object->comment = $fields['comment'];
        $object->save();
    }

    public static function add(array $fields): void
    {
        $object = new self();
        $object->fill($fields);
        $object->password = bcrypt($fields['password']);
        $object->save();
    }

    public static function edit(array $fields, string $id): void
    {
        $object = self::find($id);
        $object->fill($fields);
        if (! is_null($fields['password'])) {
            $object->password = bcrypt($fields['password']);
        }
        $object->save();
    }

    public static function remove(string $id): void
    {
        $object = self::find($id);
        $object->delete();
    }
}
