<?php

namespace App\Http\Requests;

use App\Interfaces\Product\ProductCreateDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest implements ProductCreateDataInterface
{
    use ProductRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|length:255',
            'price' => 'required|integer',
            'enabled' => 'required|boolean',
            'slug' => 'string|length:255|unique:products,slug',
        ];
    }
}
