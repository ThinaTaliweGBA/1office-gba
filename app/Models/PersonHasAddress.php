<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonHasAddress extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'person_has_address'; 


    
}
