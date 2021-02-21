<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookReviewRatingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'rating_number' => 'required|integer|between:1,5',
            'review' => 'required',
            'user_id' => 'nullable'
        ];
    }

    public function validationData()
    {
        $this->merge([
            'user_id' => Request()->user()->id,
        ]);
        return $this->all();
    }
}
