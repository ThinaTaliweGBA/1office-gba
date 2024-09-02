<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPaymentReceipt extends Model
{
    use HasFactory;

    protected $table = 'membership_payment_receipts'; // Specify the table name if not following convention

    protected $fillable = [
        'membership_id',
        'transaction_date',
        'transaction_description',
        'receipt_number',
        'receipt_value',
        'currency_id',
        'bu_id',
        'transaction_type_id',
        'payment_method_id',
    ];

    // Add any relationships, accessors, or additional functionality below
}
