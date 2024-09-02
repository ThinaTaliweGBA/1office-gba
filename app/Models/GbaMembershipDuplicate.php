<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaMembershipDuplicate extends Model
{
    use HasFactory;
    protected $connection = 'oo_duplicate';
    protected $table = 'gba_memberships_by_id_duplicate_log'; 
}
