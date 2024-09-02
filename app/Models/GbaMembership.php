<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GbaMembership extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'gba_memberships_by_id';


public function membershipDuplicates()
{
    return $this->hasMany(GbaMembershipDuplicate::class, 'membership_id', 'membership_id');
}

}
