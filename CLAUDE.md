# FixMyUtility — Laravel + MySQL CMS

## Project Overview
Utility bill dispute SaaS serving USA, Canada, UK.
Customers upload utility bills (electricity, gas, water, internet).
AI (Claude API) analyzes bills for errors and overcharges.
Generates dispute letters and analysis reports as PDFs.

## Tech Stack
- Laravel 11, PHP 8.3
- MySQL 8 (database: fixmyutility)
- Livewire 3 + Blade + Tailwind CSS 4 + Alpine.js
- Filament v3 (admin panel at /admin)
- spatie/laravel-medialibrary (images/files)
- spatie/laravel-sluggable (auto URL slugs)
- spatie/laravel-permission (roles: admin, editor, customer)
- barryvdh/laravel-dompdf (PDF report generation)
- laravel/cashier (Stripe subscriptions)
- echolabsdev/prism-php (Claude AI integration)
- Redis (cache, sessions, queues)
- Cloudflare R2 / S3 (bill file storage)

## Design System (from Figma)
- Primary color: #7C5C3E (warm brown)
- Secondary: #C49A72
- Accent: #E8A87C
- Background: #FAF6F0
- Text: #3D2B1F
- Font: Plus Jakarta Sans (headings), Inter (body)
- Style: Warm, earthy, friendly

## Currencies
- USD for USA, GBP for UK, CAD for Canada
- Detect from user country on registration

## Roles & Permissions
- admin: full access to everything
- editor: manage CMS content only
- customer: own dashboard, bills, reports only

## Key Models
- Page, Service, Post, PostCategory, Faq, Testimonial, Plan
- User (with Cashier trait), Bill, BillAnalysis, Dispute, UtilityProvider
- Setting (key/value site settings), Menu, MenuItem, EmailTemplate

## CMS Routes
- / (home), /services, /services/{slug}, /about, /contact
- /blog, /blog/{slug}, /pricing
- /dashboard (customer portal)
- /admin (Filament admin panel)

## AI Pipeline
1. User uploads PDF bill → stored in S3/R2
2. spatie/pdf-to-text extracts text
3. Prism PHP sends to Claude API with tariff context
4. Claude returns JSON: errors[], overcharge_amount, dispute_letter
5. DomPDF generates report PDF
6. Email sent to customer via Laravel Mail

## Module Implementation
- [x] **User Management (RBAC)**: Admin, Editor, Customer roles using `spatie/laravel-permission`.
- [x] **Blog Writing Module**: Filament-based backend for posts and categories.
- [x] **Pricing & Packages**: Management of plans and features in Filament.
- [x] **Services Management**: Full CRUD for utility services in admin panel.
- [x] **Email Templates**: Dynamic template builder and application-wide integration.
- [x] **Leads Management**: Contact form on each service page with phone/email capture.

## Code Style
- Use Laravel best practices: Services, Actions, Form Requests
- Models in app/Models, Services in app/Services
- Livewire components in app/Livewire
- Filament resources in app/Filament/Resources
- Always use MySQL transactions for multi-step operations
- All forms must have CSRF protection and validation
- Use Laravel queues for any operation over 2 seconds
- Follow PSR-12 coding standards