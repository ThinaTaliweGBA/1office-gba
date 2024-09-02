<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bu;

class EmployeeRole extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'employee_role';

    protected $fillable = [
        'name',
        'description',
        'bu_id',
        'sales_role',
        'operation_role',
        'purchase_role',
        'admin_role',
        'finance_role',
        'accounting_role',
        'hr_role',
        'tech_role',
        'rnd_role'
    ];

    public function businessUnit() {
        return $this->belongsTo(Bu::class, 'bu_id');
    }
}
