<?php

namespace App\Http\Api\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Traits\ResponseHelper;


class StorePostImageRequest extends FormRequest
{
    use ResponseHelper;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(!(request()->user()->id == Post::find($this->post)->user_id))
            $this->failure('Доступно только автору поста', 403);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'img' =>['required', 'image:jpg,jpeg,png', 'max:5120'],
        ];
    }
}
