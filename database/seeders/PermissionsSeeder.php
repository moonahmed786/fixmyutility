<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Access Control
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete',

            // Users
            'users.view', 'users.create', 'users.edit', 'users.delete',

            // CMS Content
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete',
            'posts.view', 'posts.create', 'posts.edit', 'posts.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'faqs.view', 'faqs.create', 'faqs.edit', 'faqs.delete',
            'testimonials.view', 'testimonials.create', 'testimonials.edit', 'testimonials.delete',
            'menus.view', 'menus.create', 'menus.edit', 'menus.delete',

            // Leads
            'inquiries.view', 'inquiries.edit', 'inquiries.delete',

            // App Data
            'bills.view', 'bills.edit', 'bills.delete',
            'bill-analyses.view', 'bill-analyses.edit', 'bill-analyses.delete',
            'disputes.view', 'disputes.edit', 'disputes.delete',
            'utility-providers.view', 'utility-providers.create', 'utility-providers.edit', 'utility-providers.delete',

            // Plans & Billing
            'plans.view', 'plans.create', 'plans.edit', 'plans.delete',

            // Settings
            'settings.view', 'settings.edit',
            'email-templates.view', 'email-templates.create', 'email-templates.edit', 'email-templates.delete',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // Give admin role all permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // Give editor role content permissions only
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions(Permission::whereIn('name', [
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete',
            'posts.view', 'posts.create', 'posts.edit', 'posts.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'faqs.view', 'faqs.create', 'faqs.edit', 'faqs.delete',
            'testimonials.view', 'testimonials.create', 'testimonials.edit', 'testimonials.delete',
            'menus.view', 'menus.create', 'menus.edit', 'menus.delete',
            'inquiries.view',
        ])->get());

        $this->command->info('Permissions seeded and assigned to admin/editor roles.');
    }
}
