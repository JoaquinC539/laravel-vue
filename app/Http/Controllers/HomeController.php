<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }
    public function welcome(Request $request)
    {
        $successMessage = $request->session()->get('success');
        $errorMessage = $request->session()->get('error');
        return view('home.welcome', [
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        ]);
    }
    public function dashboard(Request $request)
    {
        
        $successMessage = $request->session()->get('success');
        $errorMessage = $request->session()->get('error');
        return view('home.dashboard', [
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        ]);
    }

}
