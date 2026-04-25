<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\UtilityProvider;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        // Settings
        $settings = [
            ['key' => 'site_name',       'value' => 'FixMyUtility',              'group' => 'general'],
            ['key' => 'contact_email',   'value' => 'support@fixmyutility.com',  'group' => 'contact'],
            ['key' => 'primary_color',   'value' => '#7C5C3E',                   'group' => 'design'],
            ['key' => 'secondary_color', 'value' => '#C49A72',                   'group' => 'design'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // Services
        $services = [
            [
                'title'   => 'Electricity Bill Audit',
                'slug'    => 'electricity-audit',
                'excerpt' => 'We analyze your electricity bills for tariff errors, meter discrepancies, and billing irregularities that could be costing you money.',
                'content' => '<p>Our AI-powered electricity audit reviews every line of your bill against current tariff rates to uncover errors before they add up. We cover residential and commercial bills across the USA, Canada, and UK.</p><h3>What we check</h3><ul><li>Standing charges and unit rates</li><li>Meter reading accuracy</li><li>Peak vs off-peak tariff application</li><li>Direct debit overpayments</li><li>Exit fees and contract terms</li></ul>',
                'icon'    => 'bolt',
                'order'   => 1,
            ],
            [
                'title'   => 'Gas Bill Audit',
                'slug'    => 'gas-audit',
                'excerpt' => 'Identify overcharges in your natural gas billing, from inaccurate meter readings to incorrect tariff rates.',
                'content' => '<p>Gas bills are notorious for estimated readings that accumulate into significant overcharges. Our audit cross-references your consumption data with published tariff rates.</p><h3>What we check</h3><ul><li>Meter reading estimates vs actuals</li><li>Unit conversion factors (calorific value)</li><li>Standing charge accuracy</li><li>Seasonal tariff misapplication</li></ul>',
                'icon'    => 'fire',
                'order'   => 2,
            ],
            [
                'title'   => 'Water Bill Audit',
                'slug'    => 'water-audit',
                'excerpt' => 'Detect leaks, billing errors, and inaccurate meter readings in your water and sewage charges.',
                'content' => '<p>Water bills often contain hidden charges that go unnoticed for years. Our audit covers both water supply and sewage charges.</p><h3>What we check</h3><ul><li>Meter reading accuracy</li><li>Rateable value assessments</li><li>Sewerage standing charges</li><li>Surface water drainage fees</li></ul>',
                'icon'    => 'droplet',
                'order'   => 3,
            ],
            [
                'title'   => 'Internet & Broadband Audit',
                'slug'    => 'internet-audit',
                'excerpt' => 'Review your broadband and internet bills for unauthorized charges, contract discrepancies, and mid-contract price hikes.',
                'content' => '<p>ISPs frequently apply mid-contract price increases, add-on charges, and bundling fees without clear communication. We review every charge on your bill.</p>',
                'icon'    => 'wifi',
                'order'   => 4,
            ],
        ];
        foreach ($services as $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // Plans
        $plans = [
            [
                'name'        => 'Basic',
                'slug'        => 'basic',
                'description' => 'Perfect for a single one-time bill audit.',
                'price_usd'   => 19.99,
                'price_gbp'   => 15.99,
                'price_cad'   => 24.99,
                'features'    => json_encode([
                    '1 Bill Analysis',
                    'AI-Powered Error Detection',
                    'Downloadable Audit Report (PDF)',
                    'Dispute Letter Generated',
                    'Email Support',
                ]),
                'bill_limit'  => 1,
                'order'       => 1,
            ],
            [
                'name'        => 'Professional',
                'slug'        => 'pro',
                'description' => 'Best for households with multiple utility providers.',
                'price_usd'   => 49.99,
                'price_gbp'   => 39.99,
                'price_cad'   => 64.99,
                'features'    => json_encode([
                    '5 Bill Analyses',
                    'AI-Powered Error Detection',
                    'Downloadable Audit Reports (PDF)',
                    'Dispute Letters for All Bills',
                    'Priority Support',
                    'Coverage: Electricity, Gas, Water, Internet',
                ]),
                'bill_limit'  => 5,
                'order'       => 2,
            ],
        ];
        foreach ($plans as $p) {
            Plan::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // FAQs
        $faqs = [
            [
                'question' => 'How does the AI bill audit work?',
                'answer'   => 'You upload your utility bill as a PDF or image. Our AI extracts the text, compares each charge against current tariff rates and regulations, and flags any discrepancies. The entire process takes 1–3 minutes.',
                'order'    => 1,
            ],
            [
                'question' => 'Which countries and utility types do you support?',
                'answer'   => 'We support electricity, gas, water, and internet bills from the USA, Canada, and United Kingdom. Pricing is provided in USD, CAD, and GBP respectively.',
                'order'    => 2,
            ],
            [
                'question' => 'Is my bill data secure?',
                'answer'   => 'Yes. All files are encrypted in transit and at rest. Your bill data is only used for the purpose of your audit and is never shared with third parties.',
                'order'    => 3,
            ],
            [
                'question' => 'What happens after the audit finds an overcharge?',
                'answer'   => 'We generate a professionally worded dispute letter that you can send directly to your utility provider. Many disputes are resolved within 2–4 weeks and result in refunds or bill credits.',
                'order'    => 4,
            ],
            [
                'question' => 'What if no overcharge is found?',
                'answer'   => 'You still receive a full audit report confirming your bill is correct. Peace of mind has value too — and you only pay once per audit.',
                'order'    => 5,
            ],
            [
                'question' => 'How long does an analysis take?',
                'answer'   => 'Most audits complete within 1 to 3 minutes. Larger or complex bills may take up to 5 minutes. You will receive an email notification once the analysis is ready.',
                'order'    => 6,
            ],
        ];
        foreach ($faqs as $i => $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // Testimonials
        $testimonials = [
            [
                'name'    => 'Sarah M.',
                'company' => 'Homeowner, Texas',
                'country' => 'US',
                'content' => 'FixMyUtility found a tariff error that had been overcharging me $38 per month for over a year. The dispute letter was professional and my provider refunded over $450.',
                'rating'  => 5,
            ],
            [
                'name'    => 'James P.',
                'company' => 'Small Business Owner, London',
                'country' => 'GB',
                'content' => 'I uploaded my business electricity bill and within 2 minutes had a detailed report showing three separate billing errors. Saved nearly £300 in the first dispute.',
                'rating'  => 5,
            ],
            [
                'name'    => 'Linda K.',
                'company' => 'Retiree, Ontario',
                'country' => 'CA',
                'content' => 'Brilliant service. The AI picked up a meter reading discrepancy my gas provider had been using for 6 months. Got a full credit on my next bill.',
                'rating'  => 5,
            ],
            [
                'name'    => 'Marcus D.',
                'company' => 'Landlord, Florida',
                'country' => 'US',
                'content' => 'I use the Pro plan for all my rental properties. Excellent value and the reports are detailed enough that my tenants can understand them clearly.',
                'rating'  => 4,
            ],
            [
                'name'    => 'Emma T.',
                'company' => 'Renter, Manchester',
                'country' => 'GB',
                'content' => 'Uploading took 30 seconds and the analysis was surprisingly thorough. Found a standing charge discrepancy and the dispute template was spot on.',
                'rating'  => 5,
            ],
            [
                'name'    => 'Raj S.',
                'company' => 'Engineer, Vancouver',
                'country' => 'CA',
                'content' => 'Used this for my water and electricity bills. The water audit found an overcharge related to sewerage fees I would never have spotted myself.',
                'rating'  => 4,
            ],
        ];
        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }

        // Utility Providers
        $providers = [
            ['name' => 'Pacific Gas and Electric (PG&E)', 'country' => 'US', 'utility_type' => 'electricity'],
            ['name' => 'Con Edison',                       'country' => 'US', 'utility_type' => 'electricity'],
            ['name' => 'Southern California Edison',       'country' => 'US', 'utility_type' => 'electricity'],
            ['name' => 'Dominion Energy',                  'country' => 'US', 'utility_type' => 'gas'],
            ['name' => 'National Grid (US)',                'country' => 'US', 'utility_type' => 'gas'],
            ['name' => 'British Gas',                      'country' => 'GB', 'utility_type' => 'gas'],
            ['name' => 'EDF Energy',                       'country' => 'GB', 'utility_type' => 'electricity'],
            ['name' => 'Octopus Energy',                   'country' => 'GB', 'utility_type' => 'electricity'],
            ['name' => 'OVO Energy',                       'country' => 'GB', 'utility_type' => 'electricity'],
            ['name' => 'Thames Water',                     'country' => 'GB', 'utility_type' => 'water'],
            ['name' => 'Severn Trent',                     'country' => 'GB', 'utility_type' => 'water'],
            ['name' => 'Hydro-Québec',                     'country' => 'CA', 'utility_type' => 'electricity'],
            ['name' => 'BC Hydro',                         'country' => 'CA', 'utility_type' => 'electricity'],
            ['name' => 'Enbridge Gas',                     'country' => 'CA', 'utility_type' => 'gas'],
        ];
        foreach ($providers as $p) {
            UtilityProvider::updateOrCreate(
                ['name' => $p['name'], 'country' => $p['country']],
                array_merge($p, ['is_active' => true])
            );
        }
    }
}
