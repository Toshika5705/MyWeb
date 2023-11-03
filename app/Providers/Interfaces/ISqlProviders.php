<?php

namespace App\Providers\Interfaces;

interface ISqlProviders {

    public function creatmemberid();

    public function updateLoginTime(string $userId, string $loginTime);
}
