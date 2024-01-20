<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'image' => 'image|mimes:jpg,jpeg,png|max:10240',
            'files.*.image' => 'required|image|mimes:jpg,jpeg,png|max:10240'
        ];
    }

    public function messages()
    {
        return[
            'image' => '指定されたファイルが画像ではありません。',
            'mimes' => '指定された拡張子が(jpeg, jpg, png)ではありません。',
            'max' => 'ファイルサイズは10MB以内で指定してください。'
        ];
    }
}
