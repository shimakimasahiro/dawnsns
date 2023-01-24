<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $request->validate(
                [
                    'mail' => 'required|string|email|max:255',
                    'password' => 'required|min:4',
                ],
                [
                'mail.required' => 'メールアドレスは必須項目です。',
                'mail.email' => 'メールアドレスを正しく入力してください。',
                'password.required' => 'パスワードは必須項目です。',
                'password.min' => 'パスワードは4文字以上で入力してください。',
                ],
            );

<<<<<<< HEAD

=======
>>>>>>> 25715a9f528fa5a2fc7b3b9dac021f1c48503acf
            $data=$request->only('mail','password');
            $username= session()->get('username');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top', compact('username'));
            }
        }
        return view("auth.login");
    }
}
