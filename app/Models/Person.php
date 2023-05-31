<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "persons";

    protected $guarded = [];

    protected $casts = [
        'birthdate' => 'datetime:d-m-Y',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
