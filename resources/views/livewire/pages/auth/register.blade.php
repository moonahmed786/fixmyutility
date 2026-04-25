<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name'                  => '',
    'email'                 => '',
    'country'               => 'US',
    'password'              => '',
    'password_confirmation' => '',
]);

rules([
    'name'     => ['required', 'string', 'max:255'],
    'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'country'  => ['required', 'string', 'size:2'],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $currency = match($validated['country']) {
        'GB' => 'GBP',
        'CA' => 'CAD',
        default => 'USD',
    };

    $validated['password'] = Hash::make($validated['password']);
    $validated['currency'] = $currency;

    event(new Registered($user = User::create($validated)));
    $user->assignRole('customer');

    Auth::login($user);
    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <div class="text-center mb-8">
        <h2 class="font-heading text-2xl font-extrabold text-dark">Create your account</h2>
        <p class="text-dark/50 text-sm mt-1">Start auditing your utility bills today</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input wire:model="name" id="name" type="text" name="name"
                          required autofocus autocomplete="name"
                          placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input wire:model="email" id="email" type="email" name="email"
                          required autocomplete="username"
                          placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <select wire:model="country" id="country"
                    class="form-input">
                <optgroup label="United States">
                    <option value="US">🇺🇸 United States (USD)</option>
                </optgroup>
                <optgroup label="Canada">
                    <option value="CA">🇨🇦 Canada (CAD)</option>
                </optgroup>
                <optgroup label="United Kingdom">
                    <option value="GB">🇬🇧 United Kingdom (GBP)</option>
                </optgroup>
            </select>
            <x-input-error :messages="$errors->get('country')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" type="password" name="password"
                          required autocomplete="new-password"
                          placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation"
                          type="password" name="password_confirmation"
                          required autocomplete="new-password"
                          placeholder="Repeat password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button class="w-full justify-center py-3 mt-2">
            Create Account
        </x-primary-button>
    </form>

    <p class="text-center text-sm text-dark/50 mt-6">
        Already have an account?
        <a href="{{ route('login') }}" wire:navigate class="text-primary font-bold hover:underline">
            Sign in
        </a>
    </p>
</div>
