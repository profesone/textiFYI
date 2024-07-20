<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\KeywordResource;
use App\Models\Keyword;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeywordApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('keyword_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KeywordResource(Keyword::all());
    }
}
