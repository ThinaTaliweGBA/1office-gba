<?php
/**
 * This file contains the Controller class.
 *
 * PHP version 7.4
 *
 * @category Controllers
 * @package  App\Http\Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Events\ReportUpdated;

/**
 * The base controller class.
 *
 * @category Controllers
 * @package  App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Constructs a new instance of the controller.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }
            if (session('error')) {
                Alert::error(session('error'));
            }
            return $next($request);
        });
    }

}
