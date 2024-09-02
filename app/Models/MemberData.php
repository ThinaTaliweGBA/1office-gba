<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberData extends Model
{
    use HasFactory;

    protected $table = 'lededata'; // Set the table name
    public $timestamps = false; // Assuming you don't have created_at and updated_at columns

}
