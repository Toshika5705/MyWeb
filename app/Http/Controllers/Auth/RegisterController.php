<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\JwtTrait;
use App\Providers\Interfaces\ISqlProviders;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $sqlProviders;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ISqlProviders $sqlProviders)
    {
        $this->middleware('guest');
        $this->sqlProviders = $sqlProviders;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $email = $data['email'];

        $payload = [
            'email' => $email
        ];
        //無需 驗證生成
        $token = JWT::encode($payload, $email, 'HS256');

        $tokenParts = explode('.', $token);

        $memberid = $this->sqlProviders->creatmemberid();

        return User::create([
            'JwtId' => $tokenParts[1],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'MemberId'=>$memberid[0]->memberid,
            'LastLoginTime'=> date('Y-m-d H:i:s'),
        ]);
    }
}
