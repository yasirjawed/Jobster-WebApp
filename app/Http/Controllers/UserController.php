<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }
    public function store(Request $request){
        $FormFields = $request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','confirmed','min:6'],
        ]);
        // hashed passoword
        $FormFields['password']=bcrypt($FormFields['password']);
        // dd($FormFields);
        // Create User
        $user = User::create($FormFields);
        // Session Login
        auth()->login($user);

        // Redirection to home
        return redirect("/")->with('message','User created & logged in!');
    }
    public function logout(Request $request){
        Auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','You have been logged out');
    }
    public function login(){
        return view("users.login");
    }
    public function authenticate(Request $request){
        $FormFields = $request->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);
        if(auth()->attempt($FormFields)){
            $request->session()->regenerate();
            return redirect("/")->with('message','You are now logged in!');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }
    public function googleLogin(){
       return Socialite::driver('google')->redirect();
    }
    public function googleHandle(Request $request){
       try {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('email',$user->email)->first();
        if(!$findUser){
            $FormFields = [
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>'1234dummy',
            ];
            $FormFields['password']=bcrypt($FormFields['password']);
            $user = User::create($FormFields);
            auth()->login($user);
            return redirect("/")->with('message','User created & logged in!');
        }
        $FormFields = [
            'email'=>$findUser->email,
            'password'=>$findUser->password
        ];
        auth()->login($findUser);
        return redirect("/")->with('message','Successfully logged in!');
       }catch(Exception $e){
            dd($e->getMessage());
       }
    }
}
