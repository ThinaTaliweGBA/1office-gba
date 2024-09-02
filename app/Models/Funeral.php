<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'funeral'; 

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function costs()
    {
        return $this->hasMany(FuneralCost::class, 'funeral_id', 'id');
    }
}
