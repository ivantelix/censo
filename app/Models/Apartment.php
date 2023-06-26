<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $table = "apartments";

    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}
