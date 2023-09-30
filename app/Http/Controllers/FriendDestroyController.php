<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendDestroyController extends Controller
{
  public function __construct() {
    $this->middleware(['auth']);
  }
  function __invoke(User $user , Request $request) {

    if ($request->user()->friendsTo()->detach($user)) {
        return back();
    }
    $request->user()->friendsFrom()->detach($user);

    return back();

  }
}
