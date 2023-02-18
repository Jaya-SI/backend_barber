<?php

namespace App\Http\Controllers\Api\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function listAntrian($id)
    {
        $antrian = Antrian::where('barber_id', $id)->get();

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

    public function detailAntrian($id)
    {
        $antrian = Antrian::findOrFail($id)->with('layananId', 'userId')->where('id', $id)->first();

        if ($antrian) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Antrian',
                'data' => $antrian,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Antrian not found',
        ], 404);
    }

    public function updateAntrian(Request $request, $id)
    {
        $antrian = Antrian::findOrFail($id);
        $data = $request->all();

        //update antrian
        $antrian->update($data);

        //check jika antrian berhasil diupdate
        if ($antrian) {
            return response()->json([
                'success' => true,
                'message' => 'Antrian updated successfully',
                'data' => $antrian
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Antrian failed to update',
            ], 409);
        }
    }

    public function deleteAntrian($id)
    {
        $antrian = Antrian::findOrFail($id);

        //delete antrian
        $antrian->delete();

        //check jika antrian berhasil dihapus
        if ($antrian) {
            return response()->json([
                'success' => true,
                'message' => 'Antrian deleted successfully',
                'data' => $antrian
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Antrian failed to delete',
            ], 409);
        }
    }
}
