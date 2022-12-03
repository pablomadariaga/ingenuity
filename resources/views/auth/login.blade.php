@extends('layouts.app')
@section('title', __('Login'))
@section('content')
<x-form-section-guest action="{{ route('login') }}">
    <x-slot name="title">{{__('Login')}}</x-slot>
    <x-slot name="description">{{__('Sign in to continue.')}}</x-slot>
    <div class="mb-4">
        <input id="email" type="email" class="form-control only-email @error('email') is-invalid @enderror" name="email"
            placeholder="{{ __('Email Address')}}" value="{{ old('email') }}" maxlength="300" required
            autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-4">
        <input id="password" type="password" class="form-control only-no-spaces @error('password') is-invalid @enderror"
            name="password" placeholder="{{__('Password')}}" minlength="8" maxlength="600" required
            autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-4 d-grid">
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
    </div>
    <div class="text-center">
        <a class="text-primary fw-light" href="{{ route('register') }}">
            {{ __("You don't have an account?") }}
        </a>
    </div>
</x-form-section-guest>

@endsection
