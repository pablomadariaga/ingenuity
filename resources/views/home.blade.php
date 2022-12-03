@extends('layouts.app')
@section('title',__('Dashboard'))
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
            <a href="{{ route('books.create') }}" class="text-decoration-none">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 my-auto">
                                <h4>{{__('Create book')}}</h4>
                                <p>{{__('For the collection')}}</p>
                            </div>
                            <div class="col-4 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                                    class="bi bi-journal-plus w-100 h-auto" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <div href="books/{book}/edit" class="text-decoration-none text-warning" id="update-directly">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 my-auto">
                                <h4>{{__('Edit book')}}</h4>
                                <input type="tel" id="update-book-id" name="update_book_id"
                                    class="form-control form-control-sm only-digits" maxlength="10">
                            </div>
                            <div class="col-4 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor"
                                    class="bi bi-journal-code  w-100 h-auto" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    {{ __('Last 5 books') }}
                    <a class="btn btn-primary btn-sm float-end" href="{{ route('books.index') }}">
                        {{__('Book list')}}
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-borderless table-sm"
                        aria-describedby="{{ __('Last 5 books') }}">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{__('Title')}}</th>
                                <th scope="col">{{__('ISBN')}}</th>
                                <th scope="col">{{__('Publication year')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastBooks as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->isbn_code}}</td>
                                <td>{{$book->publication_year}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
