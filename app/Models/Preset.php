<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'database_presets';

    protected $fillable = ['name', 'description', 'source_erp_system_id', 'system_id', 'company_id', 'bu_id', 'warehouse_id', 'address_id'];
}
