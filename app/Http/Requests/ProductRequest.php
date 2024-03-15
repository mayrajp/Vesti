<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'products' => 'required|array',
            'integration_id.*'=> 'required|string|max:255',
            'code.*' => 'required|string|max:255',
            'name.*' => 'required|string|max:255',
            'active.*' => 'required|boolean',
            'description.*' => 'nullable|string|max:255',
            'composition.*' => 'nullable|string|max:255',
            'brand.*' =>  'nullable|string|max:255',
            'price.*' => 'required|numeric',
            'promotion.*' => 'nullable|boolean',
            'price_amount.*' => 'nullable|numeric',
            'categories.*' => 'nullable|array',
            'weight.*' => 'nullable|numeric',
            'height.*' => 'nullable|numeric',
            'width.*' => 'nullable|numeric',
            'length.*' => 'nullable|numeric',
            'variations.*'=>'required|array',
            'variations.*.sku' => 'required|string|max:255',
            'variations.*.size' =>'required|string|max:255',
            'variations.*.color' => 'required|string|max:255',
            'variations.*.quantity' => 'required|numeric',
            'variations.*.order' => 'required|numeric',
            'variations.*.unit_type' => 'required|string|max:255',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
