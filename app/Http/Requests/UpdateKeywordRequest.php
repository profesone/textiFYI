<?php

namespace App\Http\Requests;

use App\Models\Keyword;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKeywordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('keyword_edit'),
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
            'keyword' => [
                'string',
                'max:120',
                'required',
            ],
            'client_id' => [
                'integer',
                'exists:clients,id',
                'required',
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'nullable',
            ],
        ];
    }
}
