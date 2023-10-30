<?php

namespace App\Providers\Servces;


use App\Providers\Interfaces\ISqlProviders;
use DB;

class SqlProviders implements ISqlProviders {

    public function creatmemberid() {
        return DB::select('SELECT [dbo].[CreateMemberID]() as memberid');
    }
}