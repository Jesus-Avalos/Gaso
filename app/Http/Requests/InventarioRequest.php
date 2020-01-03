<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioRequest extends FormRequest
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
            'nombre'            => 'required',
            'tipo'              => 'required',
            'unidad'            => 'required',
            'cantidad'          => 'required',
            'por_unidad'        => 'required|min:1',
            'precio_unidad'     => 'required',
            'stock_min'         => 'required'
        ];
    }
}
