<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class UserRequest extends FormRequest
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
        $user = User::find($this->user_id);

        if ($user) {
            $rules = [
                'role_id' => [
                    'required',
                    'integer'
                ],
                'name' => [
                    'required',
                    'string',
                ],
                'email' => [
                    'string',
                    Rule::unique('users')->where(fn (Builder $query) => $query->where('id', '!=', $user->id)),
                ],
                'password' => [
                    'required', 
                    'string'
                ]
            ];
        }
        else {
            $rules = [
                'role_id' => [
                    'required',
                    'integer'
                ],
                'name' => [
                    'required',
                    'string',
                ],
                'email' => [
                    'required',
                    'string',
                    'unique:users'
                ],
                'password' => [
                    'required', 
                    'string'
                ]
            ];
        }

        return $rules;
    }
}
