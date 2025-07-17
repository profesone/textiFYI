<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $clients = Client::with(['user', 'dispatches', 'textifyiNumbers'])->get();
        return response()->json($clients);
    }
}
