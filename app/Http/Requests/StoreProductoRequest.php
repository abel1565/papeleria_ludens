<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol_id === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array

    {
        $producto = $this->route('producto');
        return [
            
            'name' => 'required|string|max:255',
            'code' => ['required','string','max:255',Rule::unique('productos')->ignore($producto)],
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'pieces_per_package' => 'required|integer|min:1',
            'pieces_per_box' => 'required|integer|min:1',
            'sale_note' => 'required|string',
            'description' => 'required|string',
            'material' => 'required|string|max:255',
            'models' => 'required|integer',
            'measurements' => 'required|string|max:255',
            'separators' => 'required|integer|min:0',
            'extra_notes' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'barcode' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            //validacion de colores 
            'colors'   => 'required|array',
            'colors.*' => 'exists:colores,id',
            //validacion de categorias
            // Regla para una sola imagen
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048', 
            'subcategoria_id' => 'required|exists:subcategoria,id',
            
        ];
    }
}
