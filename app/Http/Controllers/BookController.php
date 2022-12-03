<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the book.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index', [
            'books' => Book::orderByDate()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.form', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \App\Http\Requests\CreateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $data = $request->validated();
        try {
            DB::transaction(function () use ($data) {
                Book::create([
                    'title' => $data['title'],
                    'isbn_code' => $data['isbn'],
                    'publication_year' => $data['publication_year'],
                    'user_id' => $data['created_by'],
                ]);
            });
        } catch (Exception $th) {
            return redirect()->back()->with('error', __('There was an error creating the book.') . $th->getMessage());
        }

        return redirect()->back()->with('status', __('Book created successfully.'));
    }

    /**
     * Display the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('books.show', [
            'book' => Book::findOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('books.form', [
            'book' => Book::findOrFail($id),
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->validated();
        try {
            DB::transaction(function () use ($data, $id) {
                $book = Book::findOrFail($id);

                $book->title = $data['title'];
                $book->isbn_code = $data['isbn'];
                $book->publication_year = $data['publication_year'];
                $book->user_id = $data['created_by'];

                $book->save();

            });
        } catch (Exception $th) {
            return redirect()->back()->with('error', __('There was an error updating the book.') . $th->getMessage());
        }

        return redirect()->back()->with('status', __('Book updated successfully.'));
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $book = Book::findOrFail($id);
                $book->delete();
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('There was an error deleting the book.') . $th->getMessage());
        }

        return redirect()->back()->with('status', __('Book deleted successfully.'));
    }
}
