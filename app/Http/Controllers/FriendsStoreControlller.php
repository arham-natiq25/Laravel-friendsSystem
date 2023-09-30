<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendsStoreControlller extends Controller
{
    function __construct() {
        $this->middleware(['auth']);
    }

    function __invoke(User $user , Request $request) {

        if($request->user()->hasPendingFriendRequestFor($user)){
            return back();
        }

        if($request->user()->id == $user->id){
            return back();
        }

        if($request->user()->friends->contains($user)){
            return back();
        }

        $request->user()->pendingFriendsTo()->attach($user); // insert  user and make friend

        return back();

    }
}
