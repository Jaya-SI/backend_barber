<?php

namespace App\Http\Controllers\Api\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LayananController extends Controller
{
    public function addLayanan(Request $request)
    {
        //create layanan
        $layanan = Layanan::create([
            'barber_id' => $request->barber_id,
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        //check jika layanan berhasil dibuat
        if ($layanan) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan created successfully',
                'data' => $layanan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan failed to create',
            ], 409);
        }
    }

    public function updateLayanan(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $data = $request->all();

        //update layanan
        $layanan->update($data);

        //check jika layanan berhasil diupdate
        if ($layanan) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan updated successfully',
                'data' => $layanan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan failed to update',
            ], 409);
        }
    }

    public function deleteLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);

        //delete layanan
        $layanan->delete();

        //check jika layanan berhasil dihapus
        if ($layanan) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan deleted successfully',
                'data' => $layanan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan failed to delete',
            ], 409);
        }
    }

    public function getLayanan($id)
    {
        $layanan = Layanan::findOrFail($id)->with('barberId')->first();

        //check jika layanan berhasil diambil
        if ($layanan) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan retrieved successfully',
                'data' => $layanan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan failed to retrieve',
            ], 409);
        }
    }

    public function getLayananByBarber($id)
    {
        $layanan = Layanan::where('barber_id', $id)->with('barberId')->get();

        //check jika layanan berhasil diambil
        if ($layanan) {
            return response()->json([
                'success' => true,
                'message' => 'Layanan retrieved successfully',
                'data' => $layanan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Layanan failed to retrieve',
            ], 409);
        }
    }
}
