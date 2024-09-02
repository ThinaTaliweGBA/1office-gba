<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use App\Settings; // Your model here
use App\Models\Layout;
use Illuminate\Support\Facades\Auth;

class ShareLayout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $layouts = Layout::all();
    //     $layoutNames = []; // Initialize an empty array to store layout names
    //     // $layouts = 'app2';

    //     $selectedLayoutIndex = 2;

    //     foreach ($layouts as $layout) {
    //         // echo $layout->name . ' '; // Access the name property of the layout
    //         $layoutNames[] = $layout->name; // Add the name to the array
    //     }

    //     $layouts = $layoutNames;
    //     // dd($layouts);
    //     // View::share('layout', $layouts->first()->name);
    //     View::share('layouts', $layouts);
    //     View::share('selectedLayoutIndex', $selectedLayoutIndex);

    //     return $next($request);
    // }

    // public function handle(Request $request, Closure $next): Response
    // {
    //     // Get the chosen layout index from the session
    //     // $selectedLayoutIndex = $request->session()->get('selectedLayoutIndex', 0);

    //     $selectedLayoutIndex = 2;

    //     $layouts = Layout::all();
    //     $layoutNames = $layouts->pluck('name')->toArray(); // Get all layout names

    //     // Get the selected layout name, or default to 'app2'
    //     $selectedLayout = $layouts[$selectedLayoutIndex]->name ?? 'app2';

    //     // Share the selected layout and all layout names with all views
    //     View::share('selectedLayoutIndex', $selectedLayoutIndex);
    //     View::share('selectedLayout', $selectedLayout);
    //     View::share('layoutNames', $layoutNames);
    //     View::share('layouts', $layouts);

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->session()->get('selectedLayoutIndex', 0));  7$user = Auth::user();
        $user = Auth::user();
        // Customize the query
        // $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        // $latestNotifications = auth()->user()->notifications()->latest()->take(10)->get();
        
        //dd($notifications);
        // Get the chosen layout index from the session
        $selectedLayoutIndex = $request->session()->get('selectedLayoutIndex', 0);

        $layouts = Layout::all();

        $layoutNames = $layouts->pluck('name')->toArray(); // Get all layout names
        $layoutsFiles = $layouts->pluck('css_file_path')->toArray(); // Get all layout paths

        // Get the selected layout name, or default to 'app2'
        $selectedLayout = $layouts[$selectedLayoutIndex]->name ?? 'app2';
        $selectedLayoutFiles = $layouts[$selectedLayoutIndex]->css_file_path ?? 'css/styles.css';
        // dd($selectedLayoutFiles);
        // Share the selected layout and all layout names with all views
        View::share('selectedLayoutIndex', $selectedLayoutIndex);
        View::share('selectedLayout', $selectedLayout);
        View::share('selectedLayoutFiles', $selectedLayoutFiles);
        View::share('layoutNames', $layoutNames);
        View::share('layouts', $layouts);
        View::share('layoutsFiles', $layoutsFiles);

        return $next($request);
    }
}
