<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeywordController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('keyword_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.keyword.index');
    }
}
