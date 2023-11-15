<?php

namespace App\Providers\Interfaces;

interface ISqlProviders {

    public function creatmemberid();

    public function updateLoginTime(string $userId, string $loginTime);

    public function InsertPortfolio(string $memberid,string $createTime, string $title,string $subtitle,string $myurl,string $updatetime);

    public function ListPortfolio(string $memberid,int $pageSize,int $pageNumber);
}
