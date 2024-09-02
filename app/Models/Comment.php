<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['text', 'author', 'link', 'users_id', 'model_name', 'model_record'];
}
