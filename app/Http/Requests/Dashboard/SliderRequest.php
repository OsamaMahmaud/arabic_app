<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Dashboard\HomePageController;

class SliderRequest extends FormRequest
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
            'title' => 'required|string|max:32|unique:sliders',
            'description' => 'required|string',
            'image_path' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'image_path.mimes' => 'يجب أن يكون الملف من نوع: png, jpg, jpeg.',
            'image_path.max' => 'حجم الصورة يجب أن لا يتجاوز 1 ميجابايت.',
        ];
    }
}