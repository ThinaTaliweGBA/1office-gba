<?php
/**
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */
namespace App\Actions\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUser
 *
 * @package App\Actions\Admin\User
 */
class CreateUser
{
    /**
     * Handle the request to create a new user.
     *
     * @param Request $request The request object.
     *
     * @return User The newly created user object.
     */
    public function handle(Request $request): User
    {
        // Create a new user with the given details.
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        // Assign roles to the newly created user.
        $roles = $request->roles ?? [];
        $user->assignRole($roles);

        // Return the newly created user object.
        return $user;
    }
}