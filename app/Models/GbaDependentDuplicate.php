<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaDependentDuplicate extends Model
{
    use HasFactory;
    protected $connection = 'oo_duplicate';
    protected $table = 'gba_dependents_duplicate_log'; 
}
