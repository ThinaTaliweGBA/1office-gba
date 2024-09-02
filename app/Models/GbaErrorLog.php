<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaErrorLog extends Model
{
    use HasFactory;
    protected $connection = 'oo_error';
    protected $table = 'gba_error_log';
}
