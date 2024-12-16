<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
            'type_of_paied' => 'required|string',
            'order_details' => 'required|array',
            'order_details.*.product_name' => 'required|string',
            'order_details.*.unit_price' => 'required|numeric',
            'order_details.*.quantity' => 'required|integer',
            'order_details.*.total_price' => 'required|numeric',
            'order_details.*.product_id' => 'required|exists:products,id',
        ];
    }
}
