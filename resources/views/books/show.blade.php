@extends('layouts.app')
@section('title', __('Book').' '.$book->title)
@section('content')
<x-form-section-auth listRoute="{{route('books.index')}}" listTitle="{{__('Book list')}}">
    <x-slot name="title">{{__('Books')}}</x-slot>
    <x-slot name="subTitle">{{__('Book').' '.$book->title}}</x-slot>

    <div class="col-12 col-md-4 mb-4">
        <label class="form-label">{{__('Title') }}</label>
        <input type="text" class="form-control" value="{{ $book->title }}" readonly>
    </div>
    <div class="col-12 col-md-4 mb-4">
        <label class="form-label">{{__('ISBN Code')}}</label>
        <input type="text"class="form-control" value="{{$book->isbn_code }}">
    </div>
    <div class="col-12 col-md-4 mb-4">
        <label class="form-label">{{__('Publication year')}}</label>
        <input type="number" class="form-control" value="{{ $book->publication_year }}">
    </div>
    <div class="col-12 col-md-4 mb-4 pe-none">
        <label class="form-label">{{__('Created by')}}</label>
        <input type="text" class="form-control" value="{{ $book->created_by }}">
    </div>
</x-form-section-auth>
@endsection

