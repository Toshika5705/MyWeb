<?php

namespace App\Providers\Interfaces;

interface ISqlProviders {

    public function creatmemberid();

    public function updateLoginTime(string $userId, string $loginTime);

     // #region Portfolio

    public function InsertPortfolio(string $memberid,string $createTime, string $title,string $subtitle,string $myurl,string $updatetime);

    public function ListPortfolio(string $memberid,int $pageSize,int $pageNumber);

    public function updatePortfolio(string $memberid,string $createTime, string $title,string $subtitle,string $myurl,string $updatetime);

    public function delPortfolio(string $memberid,string $createTime);

    // #endregion
}
