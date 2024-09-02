<?php

/**
 * Role Model File
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

use Spatie\Permission\Models\Role as OriginalRole;

/**
 * Extends the Spatie\Permission\Models\Role model to add fillable attributes.
 */
class Role extends OriginalRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at'
    ];
}
