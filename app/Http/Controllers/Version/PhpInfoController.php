<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhpInfoController extends Controller
{
    public function info()
    {
        return view('info.phpinfo');
    }
}
