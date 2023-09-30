<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __invoke(Request $request) {

       return view('dashboard',[

        'statuses' =>$request->user()->friendStatuses()->with('user')->get()

       ]);
    }
}
