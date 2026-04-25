@extends('layouts.dashboard')

@section('pageTitle', 'Profile Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">

    <p class="text-dark/50 text-sm -mt-2">Manage your account information and security.</p>

    {{-- Update Profile Info --}}
    <div class="card p-8">
        <h2 class="font-heading text-lg font-bold text-dark mb-1">Profile Information</h2>
        <p class="text-sm text-dark/50 mb-6">Update your name and email address.</p>
        <livewire:profile.update-profile-information-form />
    </div>

    {{-- Update Password --}}
    <div class="card p-8">
        <h2 class="font-heading text-lg font-bold text-dark mb-1">Update Password</h2>
        <p class="text-sm text-dark/50 mb-6">Use a long, random password to stay secure.</p>
        <livewire:profile.update-password-form />
    </div>

    {{-- Delete Account --}}
    <div class="card p-8">
        <h2 class="font-heading text-lg font-bold text-dark mb-1">Delete Account</h2>
        <p class="text-sm text-dark/50 mb-6">Permanently delete your account and all associated data.</p>
        <livewire:profile.delete-user-form />
    </div>
</div>
@endsection
