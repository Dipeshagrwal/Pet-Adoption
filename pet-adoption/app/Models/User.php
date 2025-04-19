<?php
namespace App\Models;

use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
   
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'mobile_no',
        'profile_picture',
        'state',
        'city',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function pets()
    {
        return $this->hasMany(Pet::class); // A user can have many pets
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class); // A user can have many adoption requests
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // Adjust based on your role implementation
    }
}   