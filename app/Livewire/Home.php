<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Testimonial;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $featuredServices = Service::where('is_active', true)->orderBy('order')->take(3)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();
        
        return view('livewire.home', [
            'featuredServices' => $featuredServices,
            'testimonials' => $testimonials,
        ])->layout('layouts.app');
    }
}
