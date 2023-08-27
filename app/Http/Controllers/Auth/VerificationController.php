<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckOtpRequest;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Mail\OtpVerification;
use App\Models\Otp;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    public static function sendCode($email)
    {
        try {
            $otp = rand(100000, 999999);
            $otp_data = ['email' => $email, 'code' => $otp, 'expires_at' => Carbon::now()->addHour(),];
            Otp::create($otp_data);
            sendMail($email,new OtpVerification($otp));
        } catch (Exception $exception) {
            return response()->json(
                ['message' => 'Something went wrong',
                    'errors' => [$exception]
                ],
                Response::HTTP_BAD_REQUEST

            );
        }
    }

    public static function checkCode($code, $email)
    {
        $otp = Otp::all()->where('email', $email)->last();
        if (isset($otp)) {
            if ($code == $otp['code']) {
                $token = \Illuminate\Support\Facades\Hash::make($code);
                $otp->token = $token;
                $otp->save();
                return $token;
            }
            return false;
        }
        return false;
    }

    public function sendOtp(SendCodeRequest $request)
    {
        VerificationController::sendCode($request['email']);
        return $this->okResponse(message: 'OTP send successfully');
    }

    public function checkOtp(CheckOtpRequest $request)
    {
        $data = $request->validated();
        $token = self::checkCode($data['code'], $data['email']);

        if (is_string($token)) {
            return $this->okResponse(['token'=>$token],'Code confirmed');
        } else {
            return $this->badRequestResponse(errors: 'The code has not been confirmed');
        }

    }

}
