<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the book.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('books.index', [
            'books' => Book::getBySearch($request->input('search', '') ?? '')
                ->getByUserId($request->input('user', 0) ?? 0)
                ->orderByDate()->paginate(10),
            'users' => User::all()
        ]);
    }

    /**
     * export to excel
     *
     * @return \Illuminate\Http\Response
     */
    public function exportToExcel():Response
    {
        $books = Book::all();
        $content = view('books.export', [
            'books' => $books
        ]);

        $content = mb_convert_encoding($content, "Windows-1252", "UTF-8");
        $status = 200;
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="books.xls"',
        ];

        return response($content, $status, $headers);
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
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:books,id'
            ]);
            $id = $request->id;
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
