<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use App\Models\Building;

class BuildingRequest extends FormRequest
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
        $building = Building::find($this->id);

        if ($building) {
            $rules = [
                'name' => [
                    'string',
                    Rule::unique('buildings')->where(fn (Builder $query) => $query->where('id', '!=', $building->id)),
                ]
            ];
        }
        else {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'unique:buildings'
                ]
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name' => [
                'required' => 'El campo :attribute es obligatorio!',
                'alpha:ascii' => 'El campo :attribute solo admite caracteres alfanumericos',
                'unique' => 'Ya existe un edificio con este nombre, Prueba con otro!'
            ]
        ];
    }
}
