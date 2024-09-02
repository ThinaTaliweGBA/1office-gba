<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaForms extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'forms-test';

        // Specify the primary key
        protected $primaryKey = 'TranID';

        // If the primary key is not an integer, specify its type
        protected $keyType = 'bigint';
    
        // If the primary key is not auto-incrementing, set this to false
        public $incrementing = false;
}
