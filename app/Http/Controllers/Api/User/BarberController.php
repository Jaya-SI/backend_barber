<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Layanan;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function listBarber()
    {
        $barber = Barber::all();

        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'List Barber',
                'data' => $barber,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Barber not found',
        ], 404);
    }

    public function detailBarber($id)
    {
        $barber = Barber::find($id);

        //get Layanan byIdBarber
        $layanan = Layanan::where('barber_id', $id)->get();

        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Barber',
                'data' => $barber,
                'layanan' => $layanan
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Barber not found',
        ], 404);
    }
}
