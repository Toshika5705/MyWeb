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

    public function updatePortfolio( $memberid,$createTime, $title, $subtitle, $myurl, $updatetime ) {
        $sql = 'UPDATE [dbo].[Portfolio] SET Title = ?,Subtitle = ?, MyUrl = ?, UpdateTime = ?
                WHERE MemberId = ? AND CreateTime = ?';
        return DB::update($sql,
            array(
                $title,
                $subtitle,
                $myurl,
                $updatetime,
                $memberid,
                $createTime
            ));
    }

    public function delPortfolio( $memberid,$createTime ) {
        $sql = 'DELETE FROM [dbo].[Portfolio] WHERE MemberId = ? AND CreateTime = ?';
        return DB::delete($sql,
            array(
                $memberid,
                $createTime
            ));
    }
}