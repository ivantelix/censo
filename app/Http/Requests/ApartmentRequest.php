<?php

namespace App\Http\Requests;

use App\Models\Apartment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class ApartmentRequest extends FormRequest
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
        $apartment = Apartment::find($this->id);

        if ($apartment) {
            $rules = [
                'building_id' => [
                    'integer'
                ],
                'name' => [
                    'string',
                    Rule::unique('apartments')->where(fn (Builder $query) => $query->where('id', '!=', $apartment->id)),
                ]
            ];
        }
        else {
            $rules = [
                'building_id' => [
                    'required',
                    'integer'
                ],
                'name' => [
                    'required',
                    'string',
                    Rule::unique('apartments')->where(fn (Builder $query) => 
                        $query->where('name', '=', $this->name)
                                ->where('building_id', '=', $this->building_id)
                    ),
                ]
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'building_id' => [
                'required' => 'El campo Edificio es obligatorio!',
                'integer' => 'El Campo :attribute solo admite valores enteros'
            ],
            'name' => [
                'required' => 'El nombre de apartamento es obligatorio!',
                'alpha:ascii' => 'El campo :attribute solo admite caracteres alfanumericos',
                'unique' => 'Ya existe un apartamento con este nombre en el edificio, Prueba con otro!'
            ]
        ];
    }
}
