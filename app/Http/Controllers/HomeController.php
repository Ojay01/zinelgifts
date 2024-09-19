<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all slides from the database
        $slides = Slide::all();
        
        // Pass the slides data to the 'welcome' view
        return view('welcome', compact('slides'));
    }
}
