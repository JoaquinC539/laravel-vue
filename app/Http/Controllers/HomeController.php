<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        
    }
    public function welcome(){
        $title="Welcome";
        $message="This is the welcome page";
        return view('home.welcome',['title'=>$title,'message'=>$message]);
    }
}
