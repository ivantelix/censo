<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCensoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() ? true : false;        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'building_id' => [
                'required'
            ],
            'apartment_id' => [
                'required'
            ],
            'name' => [
                'required',
                'string',
            ],
            'lastname' => [
                'required',
                'string'
            ],
            'dni' => [
                'required',
                'unique:persons',
                'string',
                'max:8'
            ],
            'phone' => [
                'string'
            ],
            'birthdate' => [
                'required',
                'string',
                'date_format:Y-m-d'
            ],
            'email' => [
                'required',
                'unique:persons',
                'email'
            ],
            'relationship' => [
                'required',
                'string'
            ],
            'reside_community' => [
                'required'
            ],
            'is_leader' => [
                'boolean'
            ]
        ];
        
        if (isset($this->leader_family_id)) {
            $rules['leader_family_id'] = [
                'required',
                'integer'
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'building_id' => [
                'required' => 'El campo Edificio es obligatorio!',
            ],
            'apartment_id' => [
                'required' => 'El campo Apartamento es obligatorio!',
            ],
            'name' => [
                'required' => 'El campo Nombres es obligatorio!',
                'string' => 'El campo debe ser solo caracteres!'
            ],
            'lastname' => [
                'required' => 'El campo Apellidos es obligatorio!',
                'string' => 'El campo debe ser solo caracteres!'
            ],
            'dni' => [
                'required' => 'El campo Cedula es obligatorio!',
                'unique' => 'El campo Cedula debe ser unico!',
                'string' => 'El campo Cedula debe solo caracteres',
                'max' => 'El campo Cedula debe contener maximo :max caracteres'
            ],
        ];
    }
}
