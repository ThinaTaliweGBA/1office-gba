<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'employee';

    // Define relationships here
    public function businessUnit()
    {
        return $this->belongsTo(Bu::class, 'bu_id');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    public function jobDescription()
    {
        return $this->belongsTo(JobDescription::class, 'job_description_id');
    }

    public function role()
    {
        return $this->belongsTo(EmployeeRole::class, 'employee_role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
