<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dispatch;
use App\Models\TextResponse;
use App\Models\TextifyiNumber;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalClients' => $this->getTotalClients(),
            'totalDispatches' => $this->getTotalDispatches(),
            'totalTextResponses' => $this->getTotalTextResponses(),
            'totalTextifyiNumbers' => $this->getTotalTextifyiNumbers(),
            'totalContacts' => $this->getTotalContacts(),
        ]);
    }

    private function getTotalClients()
    {
        return Client::where('user_id', auth()->id())->count();
    }

    private function getTotalDispatches()
    {
        return Dispatch::where('client_id', auth()->id())->count();
    }

    private function getTotalTextResponses()
    {
        return TextResponse::where('dispatch_id', auth()->id())->count();
    }

    private function getTotalTextifyiNumbers()
    {
        return TextifyiNumber::where('client_id', auth()->id())->count();
    }

    private function getTotalContacts()
    {
        return Contact::where('client_id', auth()->id())->count();
    }

}
