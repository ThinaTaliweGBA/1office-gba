<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'job_description';

    public function businessUnit() {
        return $this->belongsTo(Bu::class, 'bu_id');
    }

    public function role() {
        return $this->belongsTo(EmployeeRole::class, 'role_id');
    }
}
