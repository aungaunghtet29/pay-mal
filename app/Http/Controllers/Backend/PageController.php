<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home(){
        $adminUsers = Auth::user()->count();
        $users = User::query()->count();
        return view('backend.home' , compact('adminUsers', 'users'));
    }


}
