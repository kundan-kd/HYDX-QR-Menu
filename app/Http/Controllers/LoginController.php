<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function authenticate(Request $request)
   {
      $auth = Auth::attempt(
         [
            'email' => strtolower($request->email),
            'password' => $request->password
         ],
         true
      );
      if ($auth) {
         $response = response()->json(['success' => true, 'user_id' => auth()->user()->id, 'user_name' => auth()->user()->name], 200);
      } else {
         $response = response()->json(['error_success' => 'credentials do not matched !'], 200);
      }
      return $response;
   }
   public function verifyotp(Request $request)
   {
      $user_email = $request->email;
      $user_otp = $request->otp;
      $check_otp = EmailOtp::where('email', $user_email)->get();
      $otp_time = $check_otp[0]->updated_at;
      $mytime = Carbon::now()->toDateTimeString();
      $startTime = Carbon::parse($otp_time);
      $finishTime = Carbon::parse($mytime);
      $otpduration = $finishTime->diffInMinutes($startTime) ?? '';
      $otp = $check_otp[0]->otp ?? '';
      $email = $check_otp[0]->email ?? '';
      if ($user_email == $email && $user_otp == $otp && $otpduration <= 15) {
         $response = response()->json(['success' => 'OTP Verified successfully'], 200);
      } else {
         $response = response()->json(['errors_success' => 'Error in OTP Verification !'], 200);
      }
      return $response;
   }
   public function updatepass(Request $request)
   {
      $user_email = $request->email;
      $pass = $request->pass;
      $cpass = $request->cpass;
      if ($pass == $cpass) {
         $pass1 = Hash::make($pass);
         $update = User::where('email', $user_email)->update(
            [
               'password' => $pass1
            ]
         );
         $response = response()->json(['success' => 'Password changed successfully'], 200);
      } else {
         $response = response()->json(['errors_success' => 'Error in changing password !'], 200);
      }
      return $response;
   }
   public function destroy(Request $request)
   {
      Auth::guard('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/admin');
   }
}
