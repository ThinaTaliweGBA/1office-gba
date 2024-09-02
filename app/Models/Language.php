<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $table = 'language'; 

     /**
     * The people who speak this language.
     */
    public function people()
    {
        // Using 'withPivot' if you want to access the 'id' field from pivot table
        return $this->belongsToMany(Person::class, 'person_has_language')
                    ->withPivot('id');
    }

    // Without Pivot (people)
    // public function people()
    // {
    //     return $this->belongsToMany(Person::class, 'person_has_language');
    // }
}
