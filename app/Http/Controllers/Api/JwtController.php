<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtController extends Controller
{
    ///註冊
    public function register(Request $request)
    {
        // Validate the request...

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token]);
    }

    /// 登入
    public function login(Request $request)
    {
        // Validate the request...

        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'access_token' => $token,
                'code' => 200
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * 获取认证用户的资料
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    /**
     * 刷新 token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();

            return response()->json(['access_token' => $token]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    /**
     * 验证 token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkToken()
    {
        try {
            JWTAuth::parseToken()->authenticate();

            return response()->json(['message' => 'Token is valid']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
