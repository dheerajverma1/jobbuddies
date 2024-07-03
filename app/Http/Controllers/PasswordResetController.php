<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{

    public function forgotPasswordView(Request $request)
    {
        return view('resetPassword.reset-password');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $token = Str::random(60);
        $email = $request->email;

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Send reset email using SendGrid
        $this->sendEmail($email, $token);
        // Mail::to($request->email)->send(new ResetPasswordEmail($token));

        return redirect()->back()->with('message', 'Password reset email sent successfully');
    }

    public function verifyToken($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset || Carbon::now()->greaterThan(Carbon::parse($passwordReset->created_at)->addMinutes(60))) {
            return redirect('/forgot-password')->with(['message' => 'Invalid or expired token'], 400);
        }

        $email = $passwordReset->email;
        return view('resetPassword.reset-password-send-form',compact('email'));
    }

    public function newPasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:12',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        return redirect('/login')->with(['message' => 'Password reset successfully']);
    }

    protected function sendEmail($email, $token)
    {
        $resetUrl = url('verify-token/'. $token);

        $emailContent = [
            'subject' => 'Password Reset Request',
            'to' => $email,
            'content' => 'Click the link to reset your password: ' . $resetUrl
        ];

        $this->sendGridEmail($emailContent);
    }

    protected function sendGridEmail($emailContent)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("test@gmail.com", "Test");
        $email->setSubject($emailContent['subject']);
        $email->addTo($emailContent['to']);
        $email->addContent("text/plain", $emailContent['content']);

        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($email);
            return $response;
        } catch (Exception $e) {
            return 'Caught exception: ' . $e->getMessage();
        }
    }

}
