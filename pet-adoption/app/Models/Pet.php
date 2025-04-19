<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'pet_type_id',
        'pet_breed_id',
        'gender',
        'vaccinated',
        'pet_characteristics',
        'user_id',
        'owner_name',
        'whatsapp_no',
        'description',
        'state', // Added: State
        'city', // Added: City
        'status',
        'pet_status',
        'edited_status',
        'rejected_reason',
        'adopted_at',
        'image', // Single image
    ];

    // Relationships
    public function petType()
    {
        return $this->belongsTo(PetType::class); // A pet belongs to a pet type
    }

    public function petBreed()
    {
        return $this->belongsTo(PetBreed::class); // A pet belongs to a pet breed
    }

    public function user()
    {
        return $this->belongsTo(User::class); // A pet belongs to a user
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function isAdopted()
    {
        return $this->pet_status === 'adopted';
    }

    public function isAdminOwned()
{
    return $this->role === 'admin';
}

public function stateRelation()
{
    return $this->belongsTo(State::class, 'state_id');
}

public function cityRelation()
{
    return $this->belongsTo(City::class, 'city_id');
}
}