<?php

/**
 * Membership Address Model File
 *
 * PHP version 9
 * 
 * @category  Model
 * @package   App\Models
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class model for membership address binding
 *
 * @package App\Models
 * 
 * @property      int $membership_id
 * @property      int $address_id
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\Membership $membership
 */
class MembershipAddress extends Model
{
    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'membership_has_address';

    use HasFactory, SoftDeletes;

    /**
     * Get the membership that owns the membership address.
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }

    /**
     * Get the address associated with the membership address.
     */
    public function address()
    {
        return $this->hasMany(Address::class, 'membership_id', 'address_id');
    }
}
