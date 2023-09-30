<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendIndexController extends Controller
{
    function __construct(){
        $this->middleware(['auth']);
    }

    function __invoke(Request $request) {
        return view('friends.index',[
          'pendingFriendsto' => $request->user()->pendingFriendsTo,
          'pendingFriendsFrom' => $request->user()->pendingFriendsFrom,
          'friends' =>$request->user()->friends
    ]);
    }


}
