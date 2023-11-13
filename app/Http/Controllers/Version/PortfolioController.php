<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Providers\Interfaces\ISqlProviders;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PortfolioController extends Controller
{
    private $sqlProviders;

    public function __construct(ISqlProviders $sqlProviders) {
        $this->sqlProviders = $sqlProviders;
    }
    
    public function folio(){
        return view("info.protfolio");
    }

    public function InsPoerfolio(Request $request){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            
            $this->sqlProviders->InsertPortfolio(
                $user->MemberId,
                $request->CreateTime,
                $request->Title,
                $request->Subtitle,
                $request->MyUrl,
                $request->UpdateTime
            );

        }catch(\Exception $e){
           return response()->json(["error" => $e->getMessage()],401);
        }

        return response()->json(['success' => '200'], 200);
    }
}
