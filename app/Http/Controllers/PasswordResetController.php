<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\PasswordResetMail;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('users.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        Log::info('Password reset requested for email: ' . $request->email);

        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                Log::info('Email not found: ' . $request->email);
                return back()->with('error', 'Email not found in our records.');
            }

            if ($request->has('use_temp_password')) {
                // Basic scenario - Send temporary password
                $tempPassword = Str::random(12);
                $user->password = Hash::make($tempPassword);
                $user->is_temporary_password = true;
                $user->save();

                Mail::to($user->email)->send(new TemporaryPasswordMail($tempPassword));
                return back()->with('success', 'A temporary password has been sent to your email.');
            } else {
                // Professional scenario - Send reset link
                $token = Str::random(64);
                $user->reset_token = $token;
                $user->reset_token_expires_at = Carbon::now()->addHours(24);
                $user->save();

                $resetLink = route('password.reset', ['token' => $token]);
                Mail::to($user->email)->send(new PasswordResetMail($resetLink));

                return back()->with('success', 'We have emailed your password reset link!');
            }
        } catch (\Exception $e) {
            Log::error('Error in password reset process: ' . $e->getMessage());
            return back()->with('error', 'Failed to process password reset: ' . $e->getMessage());
        }
    }

    public function showResetForm(Request $request, $token)
    {
        $user = User::where('reset_token', $token)
            ->where('reset_token_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return redirect()->route('forgot_password')->with('error', 'Invalid or expired reset link.');
        }

        return view('users.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::where('reset_token', $request->token)
                ->where('reset_token_expires_at', '>', Carbon::now())
                ->first();

            if (!$user) {
                return back()->with('error', 'Invalid or expired reset token.');
            }

            $user->password = Hash::make($request->password);
            $user->reset_token = null;
            $user->reset_token_expires_at = null;
            $user->is_temporary_password = false;
            $user->save();

            return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            return back()->with('error', 'Failed to reset password: ' . $e->getMessage());
        }
    }

    public function showChangePasswordForm()
    {
        return view('users.change_password');
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->is_temporary_password = false;
            $user->save();

            return redirect()->route('home')->with('success', 'Your password has been changed successfully.');
        } catch (\Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage());
            return back()->with('error', 'Failed to change password: ' . $e->getMessage());
        }
    }
} 