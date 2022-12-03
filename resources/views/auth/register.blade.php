@extends('layouts.app')

@section('content')
<x-form-section action="{{ route('register') }}">
    <x-slot name="title">{{__('Register')}}</x-slot>
    <x-slot name="description">{{__('Sign up to manage books.')}}</x-slot>
    <div class="mb-4">
        <input id="name" type="text" class="form-control only-letters @error('name') is-invalid @enderror" name="name"
            placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="250" required autocomplete="name"
            autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-4">
        <input id="email" type="email" class="form-control only-email @error('email') is-invalid @enderror" name="email"
            placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" maxlength="300" required
            autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-4">
        <input id="password" type="password" class="form-control only-no-spaces @error('password') is-invalid @enderror"
            name="password" placeholder="{{ __('Password') }}" maxlength="600" minlength="8" required
            autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-4">
        <input id="password-confirm" type="password" class="form-control only-no-spaces only-no-paste"
            name="password_confirmation" placeholder="{{ __('Confirm Password') }}" maxlength="600" minlength="8"
            required autocomplete="new-password">
    </div>

    <div class="mb-4 d-grid">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
    <div class="text-center">
        <a class="text-primary fw-light" href="{{ route('login') }}">
            {{ __('Already have an account?') }}
        </a>
    </div>
</x-form-section>
@endsection
