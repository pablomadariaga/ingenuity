<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:500',
            'isbn' => ['required','unique:books,isbn_code,' . $this->isbn , 'max:17', new Isbn],
            'publication_year' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'created_by' => 'required|integer|exists:users,id'
        ];
    }
}
