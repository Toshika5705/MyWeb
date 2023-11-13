<?php

namespace App\Providers\Servces;


use App\Providers\Interfaces\ISqlProviders;
use DB;

class SqlProviders implements ISqlProviders {

    public function creatmemberid() {
        return DB::select('SELECT [dbo].[CreateMemberID]() as memberid');
    }
    public function updateLoginTime($userId, $loginTime) {


        // 如果你想使用 Query Builder 進行更新，可以這樣寫：
        return DB::table('users')->where('JwtId', $userId)->update(['LastLoginTime' => $loginTime]);

    }
}