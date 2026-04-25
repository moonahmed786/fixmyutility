@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-6xl font-extrabold text-dark mb-8">About <span class="text-primary">FixMyUtility</span></h1>
        
        <div class="prose prose-lg max-w-none text-dark/80">
            <p class="text-xl font-medium mb-8">We started FixMyUtility with a simple goal: to help consumers get back the money they are overcharged by utility companies.</p>
            
            <p>Utility bills are complex. Between estimated readings, varying tariffs, and hidden fees, it's easy for errors to slip through. Most people don't have the time or expertise to audit their own bills.</p>
            
            <h3 class="text-2xl font-bold text-dark mt-12 mb-6">Our Mission</h3>
            <p>To provide professional-grade utility auditing at an affordable price using cutting-edge AI technology. We empower consumers to take control of their utility costs and ensure they are only paying for what they use.</p>
            
            <h3 class="text-2xl font-bold text-dark mt-12 mb-6">How It Works</h3>
            <ol>
                <li><strong>Upload:</strong> You provide your bill in PDF or image format.</li>
                <li><strong>Analyze:</strong> Our AI scans every line item against tariff databases.</li>
                <li><strong>Report:</strong> You receive a detailed breakdown of findings.</li>
                <li><strong>Dispute:</strong> We provide a formal letter you can send to your provider.</li>
            </ol>
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-8 rounded-2xl border border-secondary/10">
                <div class="text-4xl font-extrabold text-primary mb-2">$500k+</div>
                <p class="text-sm font-bold text-dark/50 uppercase tracking-widest">Savings Found</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-secondary/10">
                <div class="text-4xl font-extrabold text-primary mb-2">10k+</div>
                <p class="text-sm font-bold text-dark/50 uppercase tracking-widest">Bills Audited</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-secondary/10">
                <div class="text-4xl font-extrabold text-primary mb-2">98%</div>
                <p class="text-sm font-bold text-dark/50 uppercase tracking-widest">Accuracy Rate</p>
            </div>
        </div>
    </div>
</div>
@endsection
