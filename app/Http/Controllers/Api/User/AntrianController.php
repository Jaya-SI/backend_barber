<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function addAntrian(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'barber_id' => 'required',
            'layanan_id' => 'required',
            'no_antrian' => 'required',
            'status' => 'required',
            'tanggal' => 'required',
        ]);

        $antrian = Antrian::create([
            'user_id' => $request->user_id,
            'barber_id' => $request->barber_id,
            'layanan_id' => $request->layanan_id,
            'no_antrian' => $request->no_antrian,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ]);

        if ($antrian) {
            return response()->json([
                'success' => true,
                'message' => 'Antrian created',
                'data' => $antrian,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Antrian failed to add',
        ], 409);
    }

    public function listAntrian($id)
    {
        $antrian = Antrian::where('barber_id', $id)->with('userId')->get();

        if ($antrian) {
            return response()->json([
                'success' => true,
                'message' => 'List Antrian',
                'data' => $antrian,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Antrian not found',
        ], 404);
    }
}
