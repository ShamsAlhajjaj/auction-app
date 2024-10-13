<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class FrontendController extends Controller
{
    public function index(){
        return Inertia::render('Frontend/Home');
    }
    public function products(){
        return Inertia::render('Frontend/Product/Index');
    }
    
    
}
