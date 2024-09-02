<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceErpSystem extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'source_erp_system';
    // public $timestamps = false;
}
