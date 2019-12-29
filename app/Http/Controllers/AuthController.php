<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\VerifyUser;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //

    use ApiResponser;

    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login', 'register', 'invitedRegister', 'checkToken', 'verify']]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token, $request->email);

        }

        return $this->errorResponse('Unauthorized', 401);

    }

    public function invitedRegister(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'verification_token' => null,
            'verified' => '1'
        ]);

        $user->save();

        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {

            return $this->respondWithToken($token, $request->email);

        }

         return response()->json(['error' => 'An  Error Occurred'], 401);
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'verification_token' => str_random(40)
        ]);

        $user->save();

         Mail::to($user)->send(new VerifyUser($user));

        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {

            return $this->respondWithToken($token, $request->email);

        }

        return response()->json(['error' => 'An  Error Occurred'], 401);

    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function getVerifiedUsers(){

        $users = User::where('verified', '1')->where('id', '!=', auth()->id())->get();

        return $users;

    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = User::USER_VERIFIED;
        $user->verification_token = null;

        $user->save();

        $user_res = new UserResource($user);

        return $this->showOne($user_res);
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('User has been Verified', 409);
        }

        Mail::to($user)->send(new VerifyUser($user));

        return $this->showMessage('Verification mail sent successfully!!');

    }
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function checkToken(Request $request){

        $token= str_replace('Bearer ', "" , $request->header('Authorization'));

              try { 
                 JWTAuth::setToken($token); //<-- set token and check
                  if (! $claim = JWTAuth::getPayload()) {
                      return response()->json(array('message'=>'user_not_found'), 404);
                  }
              } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                  return response()->json(array('message'=>'token_expired'), 404);
              } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                  return response()->json(array('message'=>'token_invalid'), 404);
              } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                  return response()->json(array('message'=>'token_absent'), 404);
              }

             return response()->json(array('message'=>'Token is Valid'), 200);


    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $email)
    {
        $user = User::where('email', $email)->first();

        $user_res = new UserResource($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user_res,
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

}
