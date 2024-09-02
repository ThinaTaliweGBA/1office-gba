<?php

/**
 * Person Model File
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

/**
 * Class Person
 * 
 * @package App\Models
 */
class Person extends Model
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

    use HasFactory;
    public $table = 'person';
    protected $connection = 'mysql';

    use HasFactory, SoftDeletes, Notifiable;

    /**
     * Get the memberships for the person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function membership()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Get the dependants for the person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dependants()
    {
        return $this->hasMany(Dependant::class, 'primary_person_id', 'id');
    }

    /**
     * Get the memberships where the person is a dependent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function membershipsAsDependent()
    {
        return $this->belongsToMany(Membership::class, 'person_has_person', 'secondary_person_id', 'primary_person_id');
    }

    // /**
    //  * Get the persons where the person is a primary person.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function dependents()
    // {
    //     return $this->hasMany(Dependant::class, 'primary_person_id');
    // }

    /**
     * Get the persons where the person is a secondary person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function primaryPersons()
    {
        return $this->hasMany(Dependant::class, 'secondary_person_id');
    }

    /**
     * Get the addresses for the person's memberships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany(MembershipAddress::class, 'membership_id', 'id');
    }
    // For person
    public function addresses()
    {
        return $this->hasManyThrough(
            Address::class,
            PersonHasAddress::class,
            'person_id',  // Foreign key on PersonHasAddress table...
            'id',         // Foreign key on Address table...
            'id',         // Local key on Person table...
            'address_id'  // Local key on PersonHasAddress table...
        );
    }

    // For person where address type is specific
    public function addressesWithType($typeId)
    {
        return $this->addresses()
                    ->where('person_has_address.adress_type_id', $typeId)
                    ->get();
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * The languages that the person speaks.
     */
    public function languages()
    {
        // Using 'withPivot' if you want to access the 'id' field from pivot table
        return $this->belongsToMany(Language::class, 'person_has_language')
                    ->withPivot('id');
    }

    //Without Pivot (languages)
    // public function languages()
    // {
    //     return $this->belongsToMany(Language::class, 'person_has_language');
    // }


    // Define a one-to-many relationship.
    public function funerals()
    {
        return $this->hasMany(Funeral::class, 'person_id');
    }

    // Add a mutator to ensure that the birth_date is stored in the correct format
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

       /**
     * Get all memberships for the person, either as a primary person or as a dependent.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allMemberships()
    {
        return $this->membership->merge($this->membershipsAsDependent);
    }


    // get employee for person

    public function employee()
    {
        return $this->hasOne(Employee::class, 'person_id');
    }

    // Define the relationship to FuneralHasPayout
    public function funeralHasPayouts()
    {
        return $this->hasMany(FuneralHasPayout::class, 'person_id');
    }

    // Define the relationship to PersonBankDetails
    public function bankDetails()
    {
        return $this->hasOne(PersonBankDetails::class, 'person_id');
    }


}
