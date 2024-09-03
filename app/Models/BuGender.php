<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuGender extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'bu_gender'; 

    /**
     * Define a relationship with Gender.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id'); // Assuming 'gender_id' exists in 'bu_gender' table
    }

    /**
     * Define a relationship with Person.
     */
    public function person()
    {
        return $this->hasOne(Person::class, 'bu_gender_id'); // Assuming 'bu_gender_id' exists in 'person' table
    }
}
