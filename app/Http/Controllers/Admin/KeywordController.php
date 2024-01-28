<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Keyword;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeywordController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('keyword_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.keyword.index');
    }

    public function create()
    {
        abort_if(Gate::denies('keyword_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.keyword.create');
    }

    public function edit(Keyword $keyword)
    {
        abort_if(Gate::denies('keyword_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.keyword.edit', compact('keyword'));
    }

    public function show(Keyword $keyword)
    {
        abort_if(Gate::denies('keyword_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $keyword->load('client', 'team');

        return view('admin.keyword.show', compact('keyword'));
    }

    public function __construct()
    {
        $this->csvImportModel = Keyword::class;
    }
}
