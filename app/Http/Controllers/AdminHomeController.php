<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    // Method to show the user home page
    public function index()
    {
        return view('admin.home'); // Make sure this view exists in resources/views/users/home.blade.php
    }
}
