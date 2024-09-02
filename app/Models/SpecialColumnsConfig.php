<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialColumnsConfig extends Model
{
    use HasFactory;
    protected $connection = '1office';
    protected $table = 'special_columns_config';
}
