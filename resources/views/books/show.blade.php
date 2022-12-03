@extends('layouts.app')
@section('title', __('Book').' '.$book->title)
@section('content')
<x-form-section-auth listRoute="{{route('books.index')}}" listTitle="{{__('Book list')}}">
    <x-slot name="title">{{__('Books')}}</x-slot>
    <x-slot name="subTitle">{{isset($book) ? __('Edit Book').' '.$book->title : __('Create book')}}</x-slot>

    <div class="col-12 col-md-4 mb-4">
        <input type="text" class="form-control" value="{{ $book->title }}" readonly>
    </div>
    <div class="col-12 col-md-4 mb-4">
        <input type="tel"class="form-control" value="{{$book->isbn_code }}">
    </div>
    <div class="col-12 col-md-4 mb-4">
        <input type="number" class="form-control" value="{{ $book->publication_year }}">
    </div>
    <div class="col-12 col-md-4 mb-4 pe-none">
        <select id="created_by" class="is-select p-2" disabled>
            <option data-placeholder="true"></option>
            @foreach ($users as $user)
            <option value="{{$user->id}}" {{ (isset($book) ? (old('created_by') ?? $book->
                user_id) :
                old('created_by'))==$user->id ? 'selected' : '' }}>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
</x-form-section-auth>

