<?php
/**
 * Business Unit Membership Status Model file
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
 * Represents a business unit membership status.
 *
 * @package App\Models
 */
class BuMembershipStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'bu_membership_status';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    use HasFactory;
}
