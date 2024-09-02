<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Traits\HasRoles;

/**
 * This middleware checks if the welcome link is valid and not expired, and if a user is found to be welcomed.
 *
 * @package App\Http\Middleware
 */
class WelcomesNewUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the welcome link has a valid signature.
        if (! $request->hasValidSignature()) {
            abort(Response::HTTP_FORBIDDEN, __('The welcome link does not have a valid signature or is expired.'));
        }

        // Check if a user is found to be welcomed.
        if (! $request->user) {
            abort(Response::HTTP_FORBIDDEN, __('Could not find a user to be welcomed.'));
        }

        // Check if the welcome link has already been used.
        if (is_null($request->user->welcome_valid_until)) {
            abort(Response::HTTP_FORBIDDEN, __('The welcome link has already been used.'));
        }

        // Check if the welcome link has expired.
        if (Carbon::create($request->user->welcome_valid_until)->isPast()) {
            abort(Response::HTTP_FORBIDDEN, __('The welcome link has expired.'));
        }

        return $next($request);
    }
}