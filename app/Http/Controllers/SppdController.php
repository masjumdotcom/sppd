<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Letter;
use App\Models\Employe;
use App\Models\User;
use App\Models\Office;

class SppdController extends Controller
{

    public function index()
    {
        $data   = Letter::with(['participants' => function($q){$q->with(['user' => function($qa){ $qa->with('employe');}]);}, 'user'])->paginate(10);
        $employe= User::with('employe')->select('id', 'name', 'fullname')->where('is_active', 1)->orderBy('name')->get();
        $conf   = Office::whereId(1)->first();
        $date   = ['date_now' => now()->format('Y-m-d'), 'date_add' => now()->addDays(5)->format('Y-m-d')];
        return Inertia::render('SPPD', ['data'=> $data, 'employes'=> $employe, 'conf'=> $conf, 'date'=> $date]);
    }
    
    public function PrintForm($num_validate)
    {
        $conf   = Office::whereId(1)->first();
        $sppd   = Letter::with([
                                'participants'      => function ($q) { $q->with(['user'=> function($qa){ $qa->with(['employe']);}]);}, 
                                'user',
                                'user_finance'      => function ($q) { $q->with(['employe']);},
                                'user_pjb_finance'  => function ($q) { $q->with(['employe']);},
                            ])
                            ->where('num_validate', $num_validate)
                            ->first();
                            
        return view('/print/sppd_print', ['conf'=> $conf, 'sppd'=> $sppd]);

        // $pdf = \PDF::loadView('/print/sppd_print', ['conf'=> $conf, 'sppd'=> $sppd]);
        // return $pdf->download('sppd_print.pdf');
    }
}
