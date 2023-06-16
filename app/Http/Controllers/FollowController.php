<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function followUser(User $user){


        if(auth()->user()->id === $user->id){
            return back()->with('error', 'You can\'t follow yourself');
        }

        $followExistCheck = Follow::where([['user_id', '=' , auth()->user()->id],['followedUserId' , '=' , $user->id]])->count();

        if($followExistCheck){
            return back()->with('error', 'You re already following this person');
        }
        $follow = new Follow  ;
        $follow->user_id = auth()->user()->id;
        $follow->followedUserId = $user->id;

        $follow->save();

        return back()->with('success', 'you followed '.$user->username . ' succesfully');

    }

    public function unfollowUser(){

    }
}
