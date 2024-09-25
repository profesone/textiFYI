<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTextifyiNumberRequest;
use App\Http\Requests\UpdateTextifyiNumberRequest;
use App\Http\Resources\Admin\TextifyiNumberResource;
use App\Models\TextifyiNumber;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TextifyiNumberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('textifyi_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TextifyiNumberResource(TextifyiNumber::all());
    }

    public function store(StoreTextifyiNumberRequest $request)
    {
        $textifyiNumber = TextifyiNumber::create($request->validated());

        return (new TextifyiNumberResource($textifyiNumber))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TextifyiNumber $textifyiNumber)
    {
        abort_if(Gate::denies('textifyi_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TextifyiNumberResource($textifyiNumber);
    }

    public function update(UpdateTextifyiNumberRequest $request, TextifyiNumber $textifyiNumber)
    {
        $textifyiNumber->update($request->validated());

        return (new TextifyiNumberResource($textifyiNumber))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TextifyiNumber $textifyiNumber)
    {
        abort_if(Gate::denies('textifyi_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textifyiNumber->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
