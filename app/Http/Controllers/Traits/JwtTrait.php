<?php

namespace App\Http\Controllers\Traits;

use DateTime;
use Illuminate\Http\Request;

use Firebase\JWT\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;

trait JwtTrait {
    public function getId(string $email) {
        
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
    public function getTime(string $logtime) {
        
        // 解析日期時間
        $dateTime = DateTime::createFromFormat('m-d-Y, h:i:s A T', $logtime);

        if ($dateTime instanceof DateTime) {
            // 轉換為目標格式
            $formattedDateTimeString = $dateTime->format('Y-m-d H:i:s P');

            // 輸出轉換後的日期時間字串
            return $formattedDateTimeString;
        } else {
            // 解析失敗時的處理邏輯
            return response()->json(['code' => '404']);
        }
    }
}