<?php

namespace App\Models\Profiles;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    /**
     * @var string $table Table name
     */
    protected $table = "emails";

    /**
     * @var string $primaryKey Primary key
     */
    protected $primaryKey = "eml_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'primary',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'usr_id'
        );
    }
}
