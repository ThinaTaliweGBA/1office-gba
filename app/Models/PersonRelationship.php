<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PersonRelationship extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'mysql';
    public $table = 'person_relationship'; 
}
