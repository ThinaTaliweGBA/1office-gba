<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $connection = '1office';
    protected $table = 'component';

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_has_component');
    }

    public function transfer_logs()
    {
        return $this->hasManyThrough(
            TransferLog::class,
            OneoModel::class, // Changed from Component to OOModel
            'component_id', // Foreign key on oo_model table...
            'oo_model_id', // Foreign key on transfer_log table...
            'id', // Local key on component table...
            'id' // Local key on oo_model table...
        );
    }
}