<?php

namespace App\Http\Requests;

use App\Models\TextResponse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTextResponseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('text_response_create'),
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
            'client_id' => [
                'integer',
                'exists:clients,id',
                'nullable',
            ],
            'campaign' => [
                'string',
                'max:100',
                'nullable',
            ],
            'response' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'notification_main' => [
                'string',
                'nullable',
            ],
            'notification_01' => [
                'string',
                'nullable',
            ],
            'keywords' => [
                'array',
            ],
            'keywords.*.id' => [
                'integer',
                'exists:keywords,id',
            ],
            'main_keyword_id' => [
                'integer',
                'exists:keywords,id',
                'nullable',
            ],
            'start_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'end_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'active' => [
                'boolean',
            ],
        ];
    }
}
