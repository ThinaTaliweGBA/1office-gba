<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralChecklistItems extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'funeral_checklist_items';
}
