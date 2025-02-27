<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function Premiun()
    {
        $role = FacadesAuth::User()->user_type;
        if ($role == 1) {
            return view('backend.index');
        } elseif ($role == 0) {
            return view('frontend.dashboard');
        }
    }
}
