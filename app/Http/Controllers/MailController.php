<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthenticationMail;
use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
  public function index(Request $request)
  {

    if ($request->ajax()) {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'errors_validation' => $validator->errors()->all(),
        ], 200);
      }
    }
    $number = random_int(1000000, 9999999);
    $emails = $request->email;
    $check_email = User::where('email', $emails)->get(['email']);
    $check_email = $check_email[0]->email ?? '';
    if ($check_email == $emails) {
      $mailData = [
        'title' => 'OTP fron Hotel Yuvraj DX',
        'body' => $number,
      ];
      $check_emailotp = EmailOtp::where('email', $emails)->get(['email']);
      $check_emailotp = $check_emailotp[0]->email ?? '';
      if ($check_emailotp == '') {
        $emailotp = new EmailOtp();
        $emailotp->email = $emails;
        $emailotp->otp = $number;
        $emailotp->save();
      } else {
        $update = EmailOtp::where('email', $emails)->update(
          [
            'otp' => $number
          ]
        );
      }
      Mail::to($emails)->send(new AuthenticationMail($mailData));
      $response = response()->json(['success' => 'OTP sent successfully'], 200);
    } else {
      $response = response()->json(['errors_success' => 'Error in sending OTP! Please Try again'], 200);
    }
    return $response;
  }
}
