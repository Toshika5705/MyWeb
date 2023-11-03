<?php

namespace App\Http\Controllers\AreaTime;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function saveTime(Request $request)
    {
        
        $originalDateTimeString = $request->input('time');
        
        // 解析日期時間
        $dateTime = DateTime::createFromFormat('m-d-Y, h:i:s A T', $originalDateTimeString);

        if ($dateTime instanceof DateTime) {
            // 轉換為目標格式
            $formattedDateTimeString = $dateTime->format('Y-m-d H:i:s P');

            // 輸出轉換後的日期時間字串
            return response()->json(['time' => $formattedDateTimeString]);
        } else {
            // 解析失敗時的處理邏輯
            return response()->json(['code' => '404']);
        }
        
    }
}
