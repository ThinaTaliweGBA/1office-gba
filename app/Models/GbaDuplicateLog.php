<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaDuplicateLog extends Model
{
    use HasFactory;
    protected $connection = 'oo_duplicate';
    protected $table = 'gba_duplicate_log'; 
}
