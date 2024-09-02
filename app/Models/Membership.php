<?php

/**
 * Membership Model File
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
use Illuminate\Notifications\Notifiable; // Import Notifiable trait
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;


/**
 * Class Membership
 * 
 * @package App\Models
 *
 * @property-read Person $person
 * @property-read Address[] $address
 * @property-read MembershipAddress[] $membershipaddress
 */
class Membership extends Model
{

    use HasFactory, SoftDeletes, Notifiable, ActivityLogger;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'membership';
    protected $connection = 'mysql';

    

    /**
     * Get the person associated with the membership.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the addresses associated with the membership.
     */
    public function address()
    {
        return $this->hasManyThrough(
            Address::class,
            MembershipAddress::class,
            'membership_id', // Foreign key on MembershipAddress table...
            'id',            // Foreign key on Address table...
            'id',            // Local key on Membership table...
            'address_id'     // Local key on MembershipAddress table...
        );
    }

        // For membership where address type is specific
        public function addressesWithType($typeId)
        {
            return $this->address()
                        ->where('membership_has_address.adress_type_id', $typeId)
                        ->get();
        }
        

    /**
     * Get the membership addresses associated with the membership.
     */
    public function membershipAddresses()
    {
        return $this->hasMany(MembershipAddress::class, 'membership_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(BuMembershipStatus::class, 'bu_membership_status_id');
    }

    public function type()
    {
        return $this->belongsTo(BuMembershipType::class, 'bu_membership_type_id');
    }
}