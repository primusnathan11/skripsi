<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function viewLogin(){
        return view('admin.auth.login');
    }
    public function viewRegister(){
        return view('admin.auth.register');
    }
    // public function login(LoginRequest $request)
    // {
    //     $credentials = [
    //         'email' => $request->user,
    //         'password' => $request->password
    //     ];

    //     if (!$token = auth('api')->setTTL(43200)->attempt($credentials)) {
    //         // check with phone
    //         $credentials = [
    //             'telp' => Formatter::IDTel(PhoneNumber::make($request->user, ['ID'])),
    //             'password' => $request->password
    //         ];
    //         if (!$token = auth('api')->attempt($credentials)) {
    //             return response()->json(['message' => ResponseMessage::ERROR_UNAUTHORIZED], 401);
    //         }
    //     }

    //     $user = auth('api')->user();
    //     // remove gender, birth_date, address, email_verified_at, created_at, updated_at
    //     unset($user->gender);
    //     unset($user->birth_date);
    //     unset($user->address);
    //     unset($user->email_verified_at);
    //     unset($user->created_at);
    //     unset($user->updated_at);

    //     // get token with refresh_ttl
    //     $refreshToken = auth('api')->setTTL(86400)->attempt($credentials);

    //     return response()->json([
    //         "message" => ResponseMessage::SUCCESS_LOGIN,
    //         "data" => [
    //             "access_token" => $token,
    //             "refresh_token" => $refreshToken,
    //             "user" => $user
    //         ]
    //     ]);
    // }
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        // $credentials = $request->only('email', 'password');

        // $token = Auth::attempt($credentials);
        // if (!$token) {
        //     // return response()->json([
        //     //     'status' => 'error',
        //     //     'message' => 'Unauthorized',
        //     // ], 401);
        //     return back()->withErrors([
        //         'password' => 'Wrong Username or Password'
        //     ]);
        // }
        // $user = Auth::user();
        // return response()->json([
        //         'status' => 'success',
        //         'user' => $user,
        //         'authorization' => [
        //             'token' => $token,
        //             'type' => 'bearer',
        //         ]
        //     ]);
        $credentials = $request->validate([
            'email' => 'required', 'string', 'email',
            'password' => 'required', 'string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Authentication passed...
            return redirect()->intended('dashboard');
        };

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/');
    // }
}
