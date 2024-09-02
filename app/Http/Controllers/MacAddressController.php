<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MacAddress;
use Illuminate\Support\Facades\Auth;

class MacAddressController extends Controller
{

    public function getMacAddress(Request $request)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('info', 'You must be logged in to proceed.');
        }

        // Get the logged-in user's ID
        $userId = Auth::id();

        // Get client's IP address
        $clientIpAddress = $request->ip();

        // Initialize an empty variable to hold the MAC address
        $macAddress = '';

        // ... [Same ARP code as before]
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

        $existingEntry = MacAddress::where('user_id', $userId)
            ->where('ip_address', $clientIpAddress)
            ->where('mac_address', $macAddress)
            ->first();

        // dd($macAddress);
        // Check if MAC address found
        if ($existingEntry) {
            // If found, send an alert
            //return redirect()->back()->with('info', 'This IP and MAC address already exist!');
            return response()->json(['Already Exist' => $existingEntry->id]);
        } elseif ($macAddress) {
            // Store into the database
            $newEntry = new MacAddress();
            $newEntry->user_id = $userId; // Add the user ID
            $newEntry->ip_address = $clientIpAddress;
            $newEntry->mac_address = $macAddress;
            $newEntry->save();
            


            // SweetAlert message
            // return redirect()
            //     ->back()
            //     ->with('success', 'Successfully added new IP and MAC address!');
            return response()->json(['mac_address' => $newEntry->mac_address]);
        } else {
            // SweetAlert message
            // return redirect()
            //     ->back()
            //     ->with('error', '');
            return response()->json(['MAC Address not found!' => $macAddress]);
        }

        // return view('mac_address', ['macAddress' => $macAddress ? $macAddress : 'MAC Address not found']);
    }
}
