<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the basic client dashboard.
     */
    public function index(Request $request): View
    {
        $client = $request->user();
        $profile = $client->clientProfile;

        return view('client.dashboard', compact('client', 'profile'));
    }
}
