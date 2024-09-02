<?php
/**
 * Address file model
 *
 * Links an address to a membership
 *
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class for the membership address
 *
 * @property int $id
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 */
class Address extends Model
{
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
    public $table = 'address';

        use HasFactory;
    protected $connection = 'mysql';

    /**
     * Get the membership that owns the address.
     *
     * @return mixed
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Get the membership addresses for the address.
     *
     * @return mixed
     */
    public function membershipaddress()
    {
        return $this->hasMany(MembershipAddress::class, 'address_id', 'id');
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class, 'adress_type_id', 'id');
    }


    // Assuming we need the reverse relationship(address belongs to which persons), which might be rare
    public function persons()
    {
        return $this->hasManyThrough(
            Person::class,
            PersonHasAddress::class,
            'address_id',  // Foreign key on PersonHasAddress table...
            'id',          // Foreign key on Person table...
            'id',          // Local key on Address table...
            'person_id'    // Local key on PersonHasAddress table...
        );
    }

    // Define the relationship to FuneralHasPayout
    public function funeralHasPayouts()
    {
        return $this->hasMany(FuneralHasPayout::class, 'address_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
}
