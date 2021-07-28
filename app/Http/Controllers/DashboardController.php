<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect('dashboard/sppd');
        // return Inertia::render('Dashboard');
    }
}
