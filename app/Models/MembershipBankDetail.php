<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipBankDetail extends Model
{
    use HasFactory;

    // Assuming 'membership_bank_details' is the table name
    protected $table = 'membership_bank_details';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Enable or disable automatic maintenance of timestamps
    public $timestamps = true;

    // Attributes that are mass assignable
    protected $fillable = [
        'membership_id', // Assuming this maps to 'membershipNumber' from your form
        'bank_branch_id', // This should map to 'debitBankName' or similar field in your form
        'bank_account_type_id', // This maps to 'eftAccountType' in your form
        'account_name', // Maps directly from form
        'account_number', // Maps directly from form
        'branch_code', // Maps directly from form
        'universal_branch_code', // Ensure you have a logic/form field to handle this
        'membership_code', // Assuming this maps to 'membershipFee' or similar in your form
        'debit_orders_per_year', // Calculated from 'debitOrderFrequency'
        // Ensure all necessary fields are included as per your actual requirements
    ];

    // Define relationships, if any, e.g., membership
    public function membership()
    {
        // Example of a relationship (adjust based on your actual database schema)
        // return $this->belongsTo(Membership::class);
        return $this->belongsTo(Membership::class, 'membership_id');
    }
    // Add more methods as needed for business logic
}
