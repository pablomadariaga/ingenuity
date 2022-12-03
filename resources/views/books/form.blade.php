@extends('layouts.app')
@section('title', isset($book) ? __('Edit Book').' '.$book->title : __('Create book'))
@section('content')
<x-form-section-auth listRoute="{{route('books.index')}}" listTitle="{{__('Book list')}}"
    action="{{ route('books.store') }}">
    @isset($book)
    @method('PUT')
    @endisset
    <x-slot name="title">{{__('Books')}}</x-slot>
    <x-slot name="subTitle">{{isset($book) ? __('Edit Book').' '.$book->title : __('Create book')}}</x-slot>

    <div class="col-12 col-md-4 mb-4">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            placeholder="{{ __('Title')}}" value="{{ isset($book) ?
                                        (old('title') ?? $book->title) :
                                        old('title') }}" maxlength="500" required autofocus>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-12 col-md-4 mb-4">
        <input id="isbn" type="tel" inputmode="numeric" class="form-control @error('isbn') is-invalid @enderror"
            name="isbn" placeholder="{{ __('ISBN code')}}" value="{{ isset($book) ?
                                        (old('isbn') ?? $book->isbn_code) :
                                        old('isbn') }}" maxlength="18" required data-format="***-***-****-**-*"
            data-mask="xxx-xxx-xxxx-xx-x">

        @error('isbn')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-12 col-md-4 mb-4">
        <input id="publication_year" type="number" min="1900" max="{{date('Y')}}" inputmode="numeric"
            name="publication_year" class="form-control only-digits @error('publication_year') is-invalid @enderror"
            placeholder="{{ __('Publication year')}}" value="{{ isset($book) ?
                                        (old('publication_year') ?? $book->publication_year) :
                                        old('publication_year') }}" maxlength="4" required>

        @error('publication_year')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-12 col-md-4 mb-4">
        <select id="created_by" class="is-select p-2 @error('created_by') is-invalid @enderror" name="created_by"
            placeholder="{{ __('Created by')}}" required>
            <option data-placeholder="true"></option>
            @foreach ($users as $user)
            <option value="{{$user->id}}" {{ (isset($book) ? (old('created_by') ?? $book->
                user_id) :
                old('created_by'))==$user->id ? 'selected' : '' }}>{{$user->name}}</option>
            @endforeach
        </select>
        @error('created_by')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-4 col-12 text-end">
        <button type="submit" class="btn btn-primary">
            {{ __('Save') }}
        </button>
    </div>
</x-form-section-auth>
@endsection
