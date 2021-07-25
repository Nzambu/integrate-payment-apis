<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    /**
     * @var string $table Table name
     */
    protected $table = "phones";

    /**
     * @var string $primaryKey Primary key
     */
    protected $primaryKey = "phn_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
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
