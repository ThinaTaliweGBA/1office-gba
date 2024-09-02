<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    // This is used for id's that are not int / big int  
    protected $casts = [
    'id' => 'string',
    ];
    
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'gender'; 
}
