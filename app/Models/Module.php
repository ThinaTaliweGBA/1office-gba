<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $connection = '1office';
    protected $table = 'module';

    public function components()
    {
        return $this->belongsToMany(Component::class, 'module_has_component');
    }

    // public function transfer_logs() {
    //     return TransferLog::whereHas('component', function ($query) {
    //         $query->whereHas('modules', function ($query) {
    //             $query->where('id', $this->id);
    //         });
    //     });
    // }
    public function transfer_logs()
    {
        return $this->hasManyThrough(
            TransferLog::class,
            OneoModel::class, // Changed from Component to OOModel
            'module_id', // Foreign key on oo_model table...
            'oo_model_id', // Foreign key on transfer_log table...
            'id', // Local key on module table...
            'id' // Local key on oo_model table...
        );
    }


    
    
}