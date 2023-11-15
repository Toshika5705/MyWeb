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

    public function InsertPortfolio( $memberid,$createTime, $title, $subtitle, $myurl, $updatetime) {

        $sql = 'INSERT Portfolio VALUES (?,?,?,?,?,?)';
        return DB::insert($sql,
            array(
                $memberid,
                $createTime,
                $title,
                $subtitle,
                $myurl,
                $updatetime
            ));
    }

    public function ListPortfolio( $memberid, $pageSize, $pageNumber ) {
        $sql = 'EXEC [dbo].[GetPortfolioList] ?,?,?';
        return DB::select($sql,
            array(
                $memberid, 
                $pageSize, 
                $pageNumber
            ));
    }
}