<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Plan;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('pages.about', compact('testimonials'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|string|max:20',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|min:10|max:2000',
            'service_slug' => 'nullable|string|exists:services,slug',
        ]);

        \App\Models\Inquiry::create($validated);

        return back()->with('success', 'Thank you! We have received your inquiry and will get back to you shortly.');
    }

    public function pricing()
    {
        $plans = Plan::where('is_active', true)->orderBy('order')->get();
        $faqs  = Faq::where('is_active', true)->orderBy('order')->get();

        return view('pages.pricing', compact('plans', 'faqs'));
    }
}
