<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{   
    public $table = 'adress_type';
    protected $connection = 'mysql';
    use HasFactory;


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    
}
