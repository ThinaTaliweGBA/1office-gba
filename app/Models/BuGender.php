<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuGender extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'bu_gender'; 
}
