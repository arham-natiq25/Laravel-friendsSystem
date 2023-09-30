<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendPatchContoller extends Controller
{
    public function __construct(){
       $this->middleware(['auth']);
    }
     function __invoke(User $user , Request $request) {


        $request->user()->pendingFriendsFrom()->updateExistingPivot($user,[
            'accepted' => true,
        ]);

        return back();
     }

}
