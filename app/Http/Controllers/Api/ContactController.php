<?php

namespace App\Http\Controllers\Api;

use App\Custom\Utility\messages;
use App\Http\Controllers\Controller;
use App\Jobs\ContactJob;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function addContact(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        $save = ContactUs::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'message' => $request->message,
            'ip' => $request->ip,
            'device' => $request->device,
            'os' => $request->os,
        ]);

        if ($save) {
            dispatch(new ContactJob($request->email));
            return response()->json([
                'status' => 'success',
                'message' => messages::contactSuccessful()
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => messages::errorInConnection()
            ],412);
        }
        
    }
}
