<?php

namespace App\Http\Requests;

use App\Models\TextifyiNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTextifyiNumberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('textifyi_number_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'textifyi_numbers' => [
                'string',
                'max:30',
                'required',
                'unique:textifyi_numbers,textifyi_numbers',
            ],
            'used' => [
                'boolean',
            ],
        ];
    }
}
