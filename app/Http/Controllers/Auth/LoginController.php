<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * 登入後將用戶重定向到何處。
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * 建立一個新的控制器實例。
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // 登入成功後的處理邏輯
        $clientTime = $request->input('time'); // 從請求中獲取客戶端時間 null
        
        // 解析日期時間
        $dateTime = DateTime::createFromFormat('m-d-Y, h:i:s A T', $clientTime);

        $LastLoginTime = $dateTime->format('Y-m-d H:i:s P');

        // 登入成功後的處理邏輯
        $user->update([
            'LastLoginTime' => $LastLoginTime, // 更新最後登入時間
        ]);
    }

}
