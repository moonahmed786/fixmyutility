<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();

    $user = auth()->user();

    if ($user->hasRole(['admin', 'editor'])) {
        // Admins and editors go to the Filament admin panel (full page reload, not Livewire navigate)
        $this->redirect('/admin', navigate: false);
    } else {
        // Customers go to their dashboard
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div>
    <div class="text-center mb-8">
        <h2 class="font-heading text-2xl font-extrabold text-dark">Welcome back</h2>
        <p class="text-dark/50 text-sm mt-1">Sign in to your account</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input wire:model="form.email" id="email" type="email" name="email"
                          required autofocus autocomplete="username"
                          placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('form.email')" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Password')" class="mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-primary hover:text-dark transition"
                       href="{{ route('password.request') }}" wire:navigate>
                        Forgot password?
                    </a>
                @endif
            </div>
            <x-text-input wire:model="form.password" id="password" type="password" name="password"
                          required autocomplete="current-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('form.password')" />
        </div>

        <div class="flex items-center gap-2">
            <input wire:model="form.remember" id="remember" type="checkbox"
                   class="rounded border-secondary/30 text-primary focus:ring-primary">
            <label for="remember" class="text-sm text-dark/60">Remember me</label>
        </div>

        <x-primary-button class="w-full justify-center py-3">
            Sign In
        </x-primary-button>
    </form>

    <p class="text-center text-sm text-dark/50 mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="text-primary font-bold hover:underline">
            Create one
        </a>
    </p>
</div>
