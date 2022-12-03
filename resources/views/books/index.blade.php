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
        @if (session('error'))
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
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
                <div class="card-header">
                    {{ __('Book list') }}
                    <div class="float-end d-flex gap-2 justify-content-end">
                        <a href="{{ route('books.excel') }}" class="btn btn-sm btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                <path
                                    d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.index') }}" method="GET">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">{{__('Filter table') }}</label>
                                </div>
                                <div class="col-sm-6 col-12 mb-4">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="{{__('Search') }}" aria-label="{{__('Search') }}"
                                        aria-describedby="btn-search" value="{{request()->get('search') ?? ''}}">
                                </div>
                                <div class="col-sm-6 col-12 mb-4">
                                    <select id="user" class="is-select p-2" name="user"
                                        placeholder="{{ __('Created by')}}" required>
                                        <option value="" {{ (request()->get('user') ?? '') == '' ? 'selected' : ''
                                            }}>All</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{ (request()->get('user') ?? '') == $user->id ?
                                            'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
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
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('books.edit', ['book' => $book]) }}"
                                                class="btn btn-warning btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('books.show', ['book' => $book]) }}"
                                                class="btn btn-secondary btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a>

                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteBook"
                                                data-bs-whatever="{{$book->id}}" class="btn btn-danger btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $books->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-books-confirmation />
@endsection
