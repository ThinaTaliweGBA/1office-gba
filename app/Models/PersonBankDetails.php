<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonBankDetails extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'person_bank_details'; 

    // Define the relationship to Person
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    // Define the relationship to FuneralHasPayout (if needed)
    public function funeralHasPayouts()
    {
        return $this->hasMany(FuneralHasPayout::class, 'person_bank_details_id');
    }
}
