<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\TextResponse;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TextResponseController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('text_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.text-response.index');
    }

    public function create()
    {
        abort_if(Gate::denies('text_response_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.text-response.create');
    }

    public function edit(TextResponse $textResponse)
    {
        abort_if(Gate::denies('text_response_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.text-response.edit', compact('textResponse'));
    }

    public function show(TextResponse $textResponse)
    {
        abort_if(Gate::denies('text_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textResponse->load('client', 'keywords', 'mainKeyword', 'team');

        return view('admin.text-response.show', compact('textResponse'));
    }

    public function __construct()
    {
        $this->csvImportModel = TextResponse::class;
    }
}
