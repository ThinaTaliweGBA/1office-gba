<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneoModel extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'oo_model';
}
