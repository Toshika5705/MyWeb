<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

use Firebase\JWT\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;

trait JwtTrait {
    public function getId(Request $request) {
        
        $email = $request->input('email');

        $payload = [
            'email' => $email
        ];
        //無需 驗證生成
        $token = JWT::encode($payload, $email, 'HS256');

        try{
            // 拆分 token
            $tokenParts = explode('.', $token);

            // 获取 Payload 部分
            return $tokenParts[1];
        }catch(JWTException $e){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
    }
}