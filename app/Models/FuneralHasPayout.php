<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralHasPayout extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'funeral_has_payout'; 

    // Define the relationship to Person
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    // Define the relationship to PersonBankDetails through Person
    public function personBankDetails()
    {
        return $this->person->bankDetails();
    }

    // Define the relationship to Address
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function funeralHasTransactions()
    {
        return $this->belongsTo(FuneralHasTransactions::class, 'funerals_has_transactions_id');
    }
}
