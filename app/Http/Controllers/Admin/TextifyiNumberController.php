<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\TextifyiNumber;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TextifyiNumberController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('textifyi_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.textifyi-number.index');
    }

    public function create()
    {
        abort_if(Gate::denies('textifyi_number_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.textifyi-number.create');
    }

    public function edit(TextifyiNumber $textifyiNumber)
    {
        abort_if(Gate::denies('textifyi_number_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.textifyi-number.edit', compact('textifyiNumber'));
    }

    public function show(TextifyiNumber $textifyiNumber)
    {
        abort_if(Gate::denies('textifyi_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textifyiNumber->load('team');

        return view('admin.textifyi-number.show', compact('textifyiNumber'));
    }

    public function __construct()
    {
        $this->csvImportModel = TextifyiNumber::class;
    }
}
