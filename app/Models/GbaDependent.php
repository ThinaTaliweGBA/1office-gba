<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaDependent extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'gba_dependents';
}
