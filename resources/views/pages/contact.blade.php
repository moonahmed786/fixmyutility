@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-extrabold text-dark mb-6">Get in <span class="text-primary">Touch</span></h1>
                <p class="text-xl text-dark/60">Have questions? Our team is here to help you save.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-10 rounded-3xl shadow-xl border border-secondary/10">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2">Full Name</label>
                            <input type="text" name="name" class="w-full border-secondary/20 rounded-xl p-4 focus:ring-primary focus:border-primary" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2">Email Address</label>
                            <input type="email" name="email" class="w-full border-secondary/20 rounded-xl p-4 focus:ring-primary focus:border-primary" placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2">Message</label>
                            <textarea name="message" rows="5" class="w-full border-secondary/20 rounded-xl p-4 focus:ring-primary focus:border-primary" placeholder="How can we help?"></textarea>
                        </div>
                        <button type="submit" class="w-full btn-primary font-bold py-4 text-lg">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="flex flex-col justify-center space-y-12">
                    <div>
                        <h4 class="text-2xl font-bold text-dark mb-4">Email Us</h4>
                        <p class="text-lg text-dark/60">support@fixmyutility.com</p>
                        <p class="text-lg text-dark/60">billing@fixmyutility.com</p>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-dark mb-4">Office</h4>
                        <p class="text-lg text-dark/60">123 Savings Street<br>London, UK EC1V 2NX</p>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-dark mb-4">Follow Us</h4>
                        <div class="flex gap-4 mt-4">
                            <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center border border-secondary/20 hover:bg-primary hover:text-white transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <!-- Add more social links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
