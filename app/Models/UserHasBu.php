<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasBu extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'users_has_bu';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bu()
    {
        return $this->belongsTo(Bu::class);
    }
}
