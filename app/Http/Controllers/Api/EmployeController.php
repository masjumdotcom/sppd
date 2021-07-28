<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    public function index(Request $request)
    {
        $data   = User::with('employe')->where('is_active', 1)->paginate(15);
        return response()->json($data);
    }
    public function create(Request $request)
    {
        $user   = User::create([
            'office_id'     => Auth()->user()->id,
            'name'          => $request->name,
            'fullname'      => $request->fullname,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);

        $user->employe()->create([
            'nip'       => $request->nip,
            'jabatan'   => $request->jabatan,
            'pangkat'   => $request->pangkat,
            'status'    => $request->status,
        ]);

        // $employe = Employe::create([
        //     'user_id'   => $user->id,
        //     'nip'       => $request->nip,
        //     'jabatan'   => $request->jabatan,
        //     'pangkat'   => $request->pangkat,
        //     'status'    => $request->status,
        // ]);

        return $this->res(true, ' Success', $user);
    }

    public function update($id, Request $request)
    {
       $user     = User::whereId($id)->first();
       $user->update([
        'name'          => $request->name,
        'fullname'      => $request->fullname,
        'email'         => $request->email,
        'is_active'     => $request->is_active,
       ]);

       $user->employe()->update([
        'nip'       => $request->nip,
        'jabatan'   => $request->jabatan,
        'pangkat'   => $request->pangkat,
        'status'    => $request->status,
        'is_active' => $request->is_active,
       ]);

       return $this->res(true, ' Success', $user);
    }
    public function destroy($id)
    {
        # code...
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
