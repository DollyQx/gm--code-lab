<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('public.portfolio.index');
    }

    public function show(string $slug): View
    {
        return view('public.portfolio.show', compact('slug'));
    }
}
