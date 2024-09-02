<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathReporter extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'death_reporter'; 
}
