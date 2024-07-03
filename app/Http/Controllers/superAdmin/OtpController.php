<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name'     => 'required|string|max:255',
        //     'email'    => 'required|string|email|max:255|unique:users',
        //     'phone'    => 'required|numeric|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()]);
        // }
        $otp = rand(100000, 999999);

        Otp::create([
            'email_address' => $request->email,
            'otp'           => $otp,
        ]);
        Mail::to($request->email)->send(new \App\Mail\SendOtpMail($otp));
        return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }


    public function verifyOtp(Request $request)
    {
        $otpRecord = Otp::where('email_address', $request->email)
                        ->where('otp', $request->otp)
                        ->first();
        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'Please Enter Valid OTP']);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $otpRecord->delete();
        return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
    }

    
    
}
