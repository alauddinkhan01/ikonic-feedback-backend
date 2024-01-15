<?php

namespace App\Http\Controllers\API\V1\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserOtp;
use App\Models\Property;
use App\Mail\UserOtpMail;
use Illuminate\Http\Request;
use App\Services\AWSSNSService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\SubscriptionService;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Http\Requests\API\V1\Auth\VerifyOtpRequest;
use App\Http\Requests\API\V1\Auth\GenerateOtpRequest;
use App\Http\Requests\API\V1\Auth\RegisterUserRequest;
use App\Http\Requests\API\V1\Auth\ResetPasswordRequest;
use App\Services\AnalyticsService;

class AuthController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_email_verified = 1;
        $user->save();

        $data['success'] = true;
        $data['data']['token'] =  $user->createToken('ikonic')->plainTextToken;
        $data['data']['user'] =  $user;
        $data['errors'] =  null;

        return response()->json($data);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            $data['success'] = true;
            $data['data']['token'] =  $user->createToken('ikonic')->plainTextToken;
            $data['data']['user'] =  $user;
            $data['errors'] =  null;

            return response()->json($data);
        } else {
            $data['success'] = false;
            $data['data'] = null;
            $data['errors'] =  [
                [
                    'type' => 'auth',
                    'message' => 'These credentials does not match our record. Please make sure that you enter correct credentials.'
                ]
            ];

            return response()->json($data);
        }
    }
}
