<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'amount', 'commission_rate_id'];

    public function commissionRate()
    {
        return $this->belongsTo(CommissionRate::class);
    }
}
