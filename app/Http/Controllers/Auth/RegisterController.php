<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $request->validate(
            [
                'username' => 'required|string|max:255',
                'mail' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required',
            ],
                ['username.required' => 'ユーザーネームは必須項目です。',
                'mail.required' => 'メールアドレスは必須項目です。',
                'mail.email' => 'メールアドレスを正しく入力してください。',
                'mail.unique' => 'このメールアドレスは既に使われています。',
                'password.required' => 'パスワードは必須項目です。',
                'password.min' => 'パスワードは4文字以上で入力してください。',
                'password.confirmed'=> '確認用パスワードが一致しません。',
                'password_confirmation.required' => '確認用パスワードは必須項目です。',
            ],
        );
            $data = $request->input();

            $this->create($data);
            session()->put('username', $data['username']);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        $username = session()->get('username');
        return view('auth.added', ['username'=>$username]);
    }
}
