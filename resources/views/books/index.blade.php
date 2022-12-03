@extends('layouts.app')
@section('title',__('Books'))
@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        @if (session('status'))
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif
        <div class="col-6">
            <h2>{{__('Books')}}</h2>
        </div>
        <div class="col-6 text-end">
            <a class="btn btn-primary" href="{{ route('books.create') }}" role="button">{{__('Create book')}}</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">{{ __('Book list') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-borderless table-sm"
                        aria-describedby="{{ __('Book list') }}">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{__('Title')}}</th>
                                <th scope="col">{{__('ISBN')}}</th>
                                <th scope="col">{{__('Publication year')}}</th>
                                <th scope="col">{{__('Created by')}}</th>
                                <th scope="col">{{__('Created at')}}</th>
                                <th scope="col" class="text-end">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->isbn_code}}</td>
                                <td>{{$book->publication_year}}</td>
                                <td>{{$book->created_by}}</td>
                                <td>{{americanFormat($book->created_at)}}</td>
                                <td class="text-end">
                                    <a href="{{ route('books.edit', ['book' => $book]) }}"
                                        class="btn btn-warning btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $books->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
