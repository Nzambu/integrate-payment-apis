<?php

namespace App\Models;

use App\Models\Profiles\Email;
use App\Models\Profiles\Phone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string $table Table name
     */
    protected $table = "users";

    /**
     * @var string $primaryKey Primary key
     */
    protected $primaryKey = "usr_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emails()
    {
        return $this->hasMany(
            Email::class,
            'user_id'
        );
    }

    public function phones()
    {
        return $this->hasMany(
            Phone::class,
            'user_id'
        );
    }
}
