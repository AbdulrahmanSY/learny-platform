<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\DeleteAccountRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponderTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    use ApiResponderTrait;

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);
            $user->assignRole(Role::where('name','student')->first());
            $user->save();

            // create otp
            VerificationController::sendCode($user->email);

            DB::commit();
            return $this->createdResponse(message: "Student created successfully");
        } catch (Exception $exception) {
            return $this->badRequestResponse(errors:[$exception->getMessage()]);
        }
    }

    public function verifyAccount(VerifyAccountRequest $request)
    {
        $code = $request['code'];
        $email = $request['email'];

        $user = User::where('email',$email)->first();
        $checker = VerificationController::checkCode($code, $email);

        if (is_string($checker)) {
            $user->verified = true;
            $user->save();

            $token = $user->createToken('auth_token')->accessToken;
            $user->load('roles');
            return $this->okResponse(new UserResource($user,$token));
        }
        return $this->badRequestResponse(errors: 'Invalid data');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('password', 'email');
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('auth_token')->accessToken;
            auth()->user()->load('roles');

            return $this->okResponse(new UserResource(auth()->user(), $token));
        }
        return $this->badRequestResponse(errors:"Invalid data");
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return $this->noContent('logout successfully');
    }

    public function deleteAccount(DeleteAccountRequest $request)
    {
        $data = $request->validated();
        $email = $data['email'];
        $code = $data['code'];
        $user = auth()->user();

        $checker = VerificationController::checkCode($code, $email);
        if ($checker) {
            $user->delete();
            $user->save();
            return $this->okResponse(message: 'Your account deleted successfully');
        } else {
            return $this->badRequestResponse(errors: 'Invalid data');
        }
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $token = $request['token'];
        $code = $request['code'];


        $user = User::where('email', $email)->first();
        $code = Otp::all()->where('email',$email)->where('token',$token)->last();

        if(isset($code)){
            if ($token == $code['token']) {
                $password = Hash::make($password);
                $user->password = $password;
                $user->save();
                $code->deleteOrFail();
                return $this->okResponse(message: 'Password reset successfully');
            } else {
                return $this->badRequestResponse(errors: 'Invalid data');
            }
        }else{
            return $this->notFoundResponse(errors: 'Not found the code number');
        }
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request['old_password'],auth()->user()->password)) {
            try {
                $user = auth()->user();
                $user->password = Hash::make($request['password']);
                $user->save();
                return $this->okResponse(message: 'Your password change it successfully');
            } catch (Exception $exception) {
                return $this->error(errors: 'Something went wrong');
            }
        }else{
            return $this->badRequestResponse(errors: 'Invalid data');
        }
    }

    public function getUsers(){
        return $this->success(UserResource::collection(User::all()));
    }
    public function getUser($id){
        $user = User::all()->where('id',$id)->first();
        $user->load('roles');

//        return $user['nationality_id'];

        return $this->success(new UserResource($user));
    }
}
