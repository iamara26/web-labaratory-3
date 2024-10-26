<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    // Method to show the user home page
    public function index()
    {
        return view('users.home'); // Make sure this view exists in resources/views/users/home.blade.php
    }
}
