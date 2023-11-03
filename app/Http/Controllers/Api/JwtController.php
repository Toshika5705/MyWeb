<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\JwtTrait;
use App\Models\User;
use App\Providers\Interfaces\ISqlProviders;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtController extends Controller
{
    use JwtTrait;
    private $sqlProviders;

    public function __construct(ISqlProviders $sqlProviders) {
        $this->sqlProviders = $sqlProviders;
    }

    
    ///註冊
    public function register(Request $request)
    {
        // Validate the request...
        $id = $this->getId($request);
        $memberid = $this->sqlProviders->creatmemberid();

        $user = User::create([
            'JwtId' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'MemberId'=>$memberid[0]->memberid,
            'LastLoginTime'=> date('Y-m-d H:i:s'),
        ]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json([
                'token' => $token,
                'code' => 200,
            ]);
    }

    /// 登入
    public function login(Request $request)
    {
        // Validate the request...

        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {

            // 登入成功，取得使用者資訊
            $user = JWTAuth::user();

            // 使用者的 JWTID
            $updateId = $user->JwtId;
            //更新JWTID
            $this->sqlProviders->updateLoginTime($updateId,date('Y-m-d H:i:s'));

            return response()->json([
                'access_token' => $token,
                'code' => 200,
                'logTime' => date('Y-m-d H:i:s'),
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
