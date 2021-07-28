<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\User;
use Inertia\Inertia;

class EmployeController extends Controller
{
    public function index()
    {
        // $data   = Employe::with('user')->where('is_active', 1)->paginate(15);
        $data   = User::with('employe')->where('is_active', 1)->paginate(15);

        return Inertia::render('EmployeView', ['data'=> $data]);
    }
}
