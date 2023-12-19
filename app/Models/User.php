<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'surname', // Добавлено поле для фамилии
        'phone_number', // Добавлено поле для номера телефона
        'email',
        'password'
    ];

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

    /**
     * Get the products that the user has added to favorites.
     */
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'user_favorites', 'user_id', 'product_id')->withTimestamps();
    }
     public function cart()
    {
        return $this->belongsToMany(Product::class, 'user_cart', 'user_id', 'product_id')->withPivot('quantity')->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function courier()
{
    return $this->hasOne(Courier::class);
}

}
