<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function folders()
    // {
    //     return $this->hasMany(Folder::class);
    // }
    public function folders()
    {
        return $this->hasMany(Folder::class, 'created_by');
    }
//     public function isExistingUser()
// {
//     // Add your logic here to determine if the user is an existing user
//     // For example, if existing users have a certain attribute set or if they meet specific criteria
//     // Return true if the user is an existing user, otherwise return false

//     // Example: Check if the user has any folders associated with them
//     return $this->folders()->exists();
// }
}
