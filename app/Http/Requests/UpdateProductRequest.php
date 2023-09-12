<?php

namespace App\Http\Requests;

use App\Interfaces\Product\ProductUpdateDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest implements ProductUpdateDataInterface
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
            'id' => 'required',
            'name' => 'required|string|length:255',
            'price' => 'required|integer',
            'enabled' => 'required|boolean',
            'slug' => 'string|length:255|unique:products,slug',
        ];
    }

    public function getId(): int|string
    {
        return $this->get('id');
    }
}
