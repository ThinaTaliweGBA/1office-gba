<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransferFix extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'data_transfer_fixes';
}
