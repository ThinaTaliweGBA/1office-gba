<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaMembershipError extends Model
{
    use HasFactory;
    protected $connection = 'oo_error';
    protected $table = 'gba_memberships_by_id_error_log';
}
