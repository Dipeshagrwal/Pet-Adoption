<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PetBreed extends Model
{
    use HasFactory;

    protected $fillable = ['pet_type_id', 'breed'];

    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }
    public function pets()
{
    return $this->hasMany(Pet::class);
}
}
