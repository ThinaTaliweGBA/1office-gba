<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaDependentError extends Model
{
    use HasFactory;
    protected $connection = 'oo_error';
    protected $table = 'gba_dependents_error_log';
}
