@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row gap-4 justify-content-center mb-4">
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
        <div class="col-6 text-right">
            <a class="btn btn-primary" href="{{__('books.create')}}" role="button">Link</a>
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
