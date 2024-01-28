<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTextResponseRequest;
use App\Http\Requests\UpdateTextResponseRequest;
use App\Http\Resources\Admin\TextResponseResource;
use App\Models\TextResponse;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TextResponseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('text_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TextResponseResource(TextResponse::with(['client', 'keywords', 'mainKeyword', 'team'])->get());
    }

    public function store(StoreTextResponseRequest $request)
    {
        $textResponse = TextResponse::create($request->validated());
        $textResponse->keywords()->sync($request->input('keywords', []));

        return (new TextResponseResource($textResponse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TextResponse $textResponse)
    {
        abort_if(Gate::denies('text_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TextResponseResource($textResponse->load(['client', 'keywords', 'mainKeyword', 'team']));
    }

    public function update(UpdateTextResponseRequest $request, TextResponse $textResponse)
    {
        $textResponse->update($request->validated());
        $textResponse->keywords()->sync($request->input('keywords', []));

        return (new TextResponseResource($textResponse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TextResponse $textResponse)
    {
        abort_if(Gate::denies('text_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textResponse->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
