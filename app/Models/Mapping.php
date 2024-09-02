<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'column_mappings';
    public $timestamps = false;

    protected $fillable = [
        'system_id',
        'company_id',
        'bu_id',
        'source_erp_system_id',
        'source_db',
        'source_table',
        'source_column',
        'oo_model_id',
        'target_db',
        'target_table',
        'target_column',
        'database_presets_id'
    ];
}
