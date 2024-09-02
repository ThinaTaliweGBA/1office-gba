<?php

/**
 * Currency Model File
 *
 * PHP versionn 9
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

/**
 * Currency Model
 * 
 * @package App\Models
 */
class Currency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'currency';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    use HasFactory;
} 