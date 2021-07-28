<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\Participant;

class SppdController extends Controller
{
    public function index(Request $request)
    {
        $sppd   = Letter::with(['participants' => function($q){$q->with(['user' => function($qa){ $qa->with('employe');}]);}, 'user'])
                            ->paginate(10);
        // return $this->res(true, 'Success', $sppd);
        return response()->json($sppd);
    }
    function randDigit($number, $digits)
    {
        return str_pad($number, $digits, '0', STR_PAD_LEFT);
    }
    
    public function add(Request $request)
    {
        $now            = now()->format('ym');
        $last_num       = Letter::where('office_id', Auth()->user()->office_id)->max('num_validate');
        if($last_num){
            $num_validate = $last_num + 1;
        }else{
            $num_validate =  Auth()->user()->office_id . $now . $this->randDigit(1, 3);
        }

        $sppd = Letter::create([
                    'num_validate'            => $num_validate,
                    'office_id'               => Auth()->user()->office_id,
                    'user_id'                 => Auth()->user()->id,
                    'user_id_auth'            => $request->user_id_auth, // this.conf.user_id_auth,
                    'user_id_finance'         => $request->user_id_finance, // this.conf.user_id_finance,
                    'user_id_pjb_finance'     => $request->user_id_pjb_finance, // this.conf.user_id_pjb_finance,
                    'nomor'                   => $request->nomor, // '',
                    'transportasi'            => $request->transportasi, // 'Angkutan Darat',
                    'dasar'                   => $request->dasar, // '',
                    'acara'                   => $request->acara, // '',
                    'cost'                    => $request->cost, // '',
                    'from'                    => $request->from, // 'Kantor Camat ' + this.conf.name,
                    'place_name'              => $request->place_name, // '',
                    'to'                      => $request->to, // '',
                    'date_start'              => $request->date_start, // this.date.date_add,
                    'date_end'                => $request->date_end, // this.date.date_add,
                    'place_issue'             => $request->place_issue, // this.conf.name,
                    'date_issue'              => $request->date_issue, // this.date.date_now,
                    'redaktur'                => $request->redaktur, // this.conf.redaktur,
        ]);
        return $this->res(true, 'Success', $sppd);
    }
    public function update($id, Request $request)
    {
        $sppd   = Letter::whereId($id)->first();
        if($sppd){
            $sppd->update([
                'user_id_auth'            => $request->user_id_auth,
                'user_id_finance'         => $request->user_id_finance,
                'user_id_pjb_finance'     => $request->user_id_pjb_finance,
                'nomor'                   => $request->nomor,
                'transportasi'            => $request->transportasi,
                'dasar'                   => $request->dasar,
                'acara'                   => $request->acara,
                'cost'                    => $request->cost,
                'from'                    => $request->from,
                'place_name'              => $request->place_name,
                'to'                      => $request->to,
                'date_start'              => $request->date_start,
                'date_end'                => $request->date_end,
                'place_issue'             => $request->place_issue,
                'date_issue'              => $request->date_issue,
                'redaktur'                => $request->redaktur,
            ]);
            return $this->res(true, 'Success', null);
        }
    }

    public function participant_add(Request $request)
    {
        $participant    = Participant::create([
            'letter_id'     => $request->letter_id,
            'user_id'       => $request->user_id,
            'cost_per_day'  => $request->cost_per_day,
            'start_work'    => $request->start_work,
            'end_work'      => $request->end_work,
            'lead'          => $request->lead,
        ]);

        if($participant){
            $data   = Participant::with(['user'=> function($q){$q->with('employe');}])->whereId($participant->id)->first();
            return $this->res(true, 'Success', $data);
        }
    }

    public function participant_update($id, Request $request)
    {
        $participant    = Participant::whereId($id)->first();
        if($participant){
            $participant->update([
                'cost_per_day'  => $request->cost_per_day,
                'start_work'    => $request->start_work,
                'end_work'      => $request->end_work,
                'lead'          => $request->lead,
            ]);
            return $this->res(true, 'Success', null);
        }
    }

    public function participant_delete($id)
    {
        $res = Participant::whereId($id)->delete();
        if($res){
            return $this->res(true, 'Remove Success', null);
        }
    }

    public function delete($id)
    {
        $sppd = Letter::whereId($id)->delete();
        if($sppd){
            return $this->res(true, 'Remove Success', null);
        }
    }
    
    private function res($status=false, $messages=null, $data=null)
    {
        return response()->json([
            'status'    => $status,
            'message'   => $messages,
            'data'      => $data, 
        ], 200, [
            'Vary' => 'Accept',
            'X-Inertia' => true,
        ]);
    }
}
