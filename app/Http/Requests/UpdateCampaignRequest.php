<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('campaign_edit'),
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
            'title' => [
                'string',
                'max:90',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
