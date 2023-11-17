<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\JwtTrait;
use App\Models\Portfolio;
use App\Providers\Interfaces\ISqlProviders;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PortfolioController extends Controller
{
    use JwtTrait;
    private $sqlProviders;

    public function __construct(ISqlProviders $sqlProviders) {
        $this->sqlProviders = $sqlProviders;
    }
    
    public function folio(){

        $user = auth()->user();

        if ($user) {
            $data = Portfolio::where('MemberId', $user->MemberId)->paginate(2);
            return view("info.protfolio", compact("data"));
        } else {
            // 未登入的處理邏輯
            return redirect()->route('login');
        }

    }

    public function InsPoerfolio(Request $request){
        try{

            if($request->has("MemberId")){
                $memberid = $request->MemberId;
            }else{
                $user = JWTAuth::parseToken()->authenticate();
                $memberid = $user->MemberId;
            }

            // 使用正則表達式檢查是否包英文
            if (preg_match('/[a-zA-Z]/', $request->CreateTime)) {
                // 包含中文
                $createtime = $this->getTime($request->CreateTime);
                $updatetime = $this->getTime($request->UpdateTime);
            } else {
                // 不包含中文
                $createtime = $request->CreateTime;
                $updatetime = $request->UpdateTime;
            }
            
            $this->sqlProviders->InsertPortfolio(
                $memberid,
                $createtime,
                $request->Title,
                $request->Subtitle,
                $request->MyUrl,
                $updatetime
            );

        }catch(\Exception $e){
           return response()->json(["error" => $e->getMessage()],401);
        }

        return response()->json(['success' => '200'], 200);
    }

    public function GetPoerfolio(Request $request){
        try{
            if($request->has("MemberId")){
                $memberid = $request->MemberId;
            }else{
                $user = JWTAuth::parseToken()->authenticate();
                $memberid = $user->MemberId;
            }

            $List = $this->sqlProviders->ListPortfolio(
                $memberid,
                $request->pageSize,
                $request->pageNumber
            );

            return response()->json(
                $List 
            );

        }catch(\Exception $e){
            return response()->json(["error" => $e->getMessage()],401);
        }
    }
}
