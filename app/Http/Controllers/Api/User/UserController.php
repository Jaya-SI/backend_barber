<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        //check jika user upload img
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $extension = $img->getClientOriginalExtension();
            $fileName = Str::random(10) . '.' . $extension;
            $uploadPath = env('UPLOAD_PATH') . "/user/img";

            //create user
            $user = User::create([
                'no_hp' => $request->no_hp,
                'name' => $request->name,
                'img' => $request->file('img')->move($uploadPath, $fileName),
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'data' => $user
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'User failed to register',
            ], 409);
        } else {
            //create user
            $user = User::create([
                'no_hp' => $request->no_hp,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'data' => $user
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'User failed to register',
            ], 409);
        }
    }

    public function login(Request $request)
    {
        //set validasi
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        //response validasi
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        //set credentials
        $credentials = $request->only('email', 'password');

        //check jika email dan password tidak sesuai
        if (!$token = auth()->guard('api_user')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }

        //check jika role bukan mitra
        if (auth()->guard('api_user')->user()->role != 'user') {
            return response()->json([
                'success' => false,
                'message' => 'You are not a mitra'
            ], 401);
        }

        //response jika berhasil login
        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => [
                'user' => auth()->guard('api_user')->user(),
                'token' => $token
            ]
        ], 200);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => 'User successfully signed out',
        ]);
    }

    public function refreshToken(Request $request)
    {
        //refresh token jwt
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());

        //set user dengan token baru
        $user = JWTAuth::setToken($refreshToken)->toUser();

        //set header "Authorization" dengan type Bearer + "token" baru
        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);

        //response user dengan token baru
        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $refreshToken,
        ], 200);
    }
}
