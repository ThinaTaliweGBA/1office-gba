<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferLog extends Model
{
    use HasFactory;

    protected $connection = '1office';
    protected $table = 'data_transfer_log';
    // public $timestamps = false;

    public function oo_model()
    {
        return $this->belongsTo(OneoModel::class);
    }

    public function special_columns_config() {
        return $this->hasOne(SpecialColumnsConfig::class, 'target_column', 'missing_field');
    }
    
    public function component()
    {
        return $this->hasOneThrough(
            Component::class,
            OneoModel::class,
            'id', // Foreign key on oo_model table...
            'id', // Foreign key on component table...
            'oo_model_id', // Local key on transfer_log table...
            'component_id' // Local key on oo_model table...
        );
    }
    
    
}
