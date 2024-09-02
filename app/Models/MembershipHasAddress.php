<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipHasAddress extends Model
{
    protected $connection = 'mysql';
    protected $table = 'membership_has_address';
    // You can add any relationships, mutators, accessors, or scopes below this line
}
