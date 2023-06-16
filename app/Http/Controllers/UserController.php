<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function showCorrectHomepage(){
        if(auth()->check()){
            
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }


    public function logout(){
        auth()->logout();

        return redirect('/')->with('success', 'Your re logged out succesfully');
    }

    public function login(Request $request){

        $incomingData = $request->validate([
            'loginusername'=>'required',
            'loginpassword'=>'required'
        ]);
        if(auth()->attempt(['username'=>$incomingData['loginusername'] , 'password'=>$incomingData['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/')->with('success','Your re logged in succesfully');
        }else{
            return redirect('/')->with('error','The username or password are incorrect');
        }
    }
    public function register(Request $request){

        $upcomingData = $request->validate([
            'username'=>["required", "min:3" , "max:20" , Rule::unique('users' , 'username')],
            'email'=>["required" , Rule::unique('users' , 'email')],
            'password'=>["required", "min:8" , 'confirmed'],
        ]);
        $upcomingData['password'] = bcrypt($upcomingData['password']);
        $user = User::create($upcomingData);
        auth()->login($user);
        return redirect('/')->with('success','Your re reggistered in succesfully');
    }
}
