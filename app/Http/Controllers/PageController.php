<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function pricing()
    {
        $plans = Plan::where('is_active', true)->orderBy('order')->get();
        return view('pages.pricing', compact('plans'));
    }
}
