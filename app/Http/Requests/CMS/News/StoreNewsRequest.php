<?php

namespace App\Http\Requests\CMS\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allowedFormat = getSetting("document_allowed_file_types", 'jpg,jpeg,png');
        $maxFileSize = getSetting('document_max_file_size', 5000);
        if ($this->method() == "PUT") {
            return [
                'title' => 'required',
                'image' => $this->file('image') ? ['required', 'image', 'mimes:' . $allowedFormat, 'max:' . $maxFileSize] : ["required"],
                'news_kategori_id' => 'required',
                'description' => 'required',
            ];
        } else {
            return [
                'title' => 'required',
                'image' => ['required', 'image', 'mimes:' . $allowedFormat, 'max:' . $maxFileSize],
                'news_kategori_id' => 'required',
                'description' => 'required',
            ];
        }
    }
}
