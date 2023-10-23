<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('posts')->where(function ($query) {
                    return $query->where('slug', request('slug'))->where('user_id', request()->user()->id);
                })->ignore(request('id'))->whereNull('deleted_at'),
            ],
            'title' => 'required',
            'body' => 'nullable|string',
            'summary' => 'nullable|string',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|string',
            'meta' => 'nullable|array',
        ];
    }
}
