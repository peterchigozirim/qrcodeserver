<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function getUser(Request $request)
    {
        $guest = Guest::create([
                    'ip' => $request->ip,
                    'device' => $request->device,
                    'host' => $request->host,
                    'org' => $request->org,
                    'os' => $request->os,
                    'city' => $request->city,
                    'country' => $request->country,
                    'region' => $request->region,
                    'timezone' => $request->timezone,
                    'location' => $request->loc,
                ]);

        if($guest){
            return 'guest saved';
        }
        else{
            return response()->json([
                    'status' => 'error',
                    'message' => 'error in connection'
                ]);
        }
    }
}
