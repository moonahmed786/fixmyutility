<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'FixMyUtility', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'support@fixmyutility.com', 'group' => 'contact'],
            ['key' => 'primary_color', 'value' => '#7C5C3E', 'group' => 'design'],
            ['key' => 'secondary_color', 'value' => '#C49A72', 'group' => 'design'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Seed Services
        $services = [
            [
                'title' => 'Electricity Bill Audit',
                'slug' => 'electricity-audit',
                'excerpt' => 'We analyze your electricity bills for tariff errors and meter discrepancies.',
                'content' => 'Full analysis of residential and commercial electricity bills across USA, Canada, and UK.',
                'icon' => 'bolt',
                'order' => 1,
            ],
            [
                'title' => 'Gas Bill Audit',
                'slug' => 'gas-audit',
                'excerpt' => 'Identify overcharges in your natural gas billing.',
                'content' => 'Expert review of gas consumption and supply charges to ensure accuracy.',
                'icon' => 'fire',
                'order' => 2,
            ],
            [
                'title' => 'Water Bill Audit',
                'slug' => 'water-audit',
                'excerpt' => 'Detect leaks and billing errors in your water utility.',
                'content' => 'Specialized auditing for water and sewage charges.',
                'icon' => 'droplet',
                'order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        // Seed Plans
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'description' => 'Perfect for single bill analysis.',
                'price_usd' => 19.99,
                'price_gbp' => 15.99,
                'price_cad' => 24.99,
                'features' => json_encode(['1 Bill Analysis', 'Email Support', 'Basic Dispute Letter']),
                'bill_limit' => 1,
                'order' => 1,
            ],
            [
                'name' => 'Professional',
                'slug' => 'pro',
                'description' => 'Best for households with multiple utilities.',
                'price_usd' => 49.99,
                'price_gbp' => 39.99,
                'price_cad' => 64.99,
                'features' => json_encode(['5 Bill Analyses', 'Priority Support', 'Full Dispute Handling']),
                'bill_limit' => 5,
                'order' => 2,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }
    }
}
