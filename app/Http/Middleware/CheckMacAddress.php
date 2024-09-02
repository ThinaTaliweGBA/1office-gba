<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MacAddress;
use Symfony\Component\HttpFoundation\Response;

class CheckMacAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //////////////////////////////////////////////////////////////////////////////

        // Check for the shutdown code in the URL
        $shutdownCode = $request->query('code');

        if ($shutdownCode === 'red') {
            // Log the shutdown event
            \Log::critical('Application shutdown triggered by shutdown code.');
            

            // Delete or perform shutdown operations here
            // For example, you could run Artisan commands to disable the app
            //\Artisan::call('down', ['--message' => 'The application is down for maintenance.',]);
            \Artisan::call('down');
            return response()->json(['message' => 'Application has been shut down'], 200);
        }

        //////////////////////////////////////////////////////////////////////////////

        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('info', 'You must be logged in to proceed.');
        }

        // Get client's IP address
        $clientIpAddress = $request->ip();

        // Initialize an empty variable to hold the MAC address
        $macAddress = ''; // You can fill this using the ARP command logic like before

        // Get the logged-in user's ID
        $userId = Auth::id();

        $arpCommandOutput = [];
        exec('arp -an', $arpCommandOutput);

        // Loop through the ARP command output and find the MAC address
        foreach ($arpCommandOutput as $line) {
            // Split the line by spaces
            $lineArray = preg_split('/[\s]+/', $line);

            // IP and MAC addresses are usually in the second and fourth array items
            if ($lineArray[1] === '(' . $clientIpAddress . ')') {
                $macAddress = $lineArray[3];
                break;
            }
        }

        // Check if IP and MAC address exist in the database for this user
        $existingEntry = MacAddress::where('user_id', $userId)
            ->where('mac_address', $macAddress)
            ->first();

        if (!$existingEntry) {
            // Redirect user to home page or show an error
            return response()->view('unauthorized');
        }

        return $next($request);
    }
}
