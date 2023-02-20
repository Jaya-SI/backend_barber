<?php

namespace App\Http\Controllers\Api\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarberController extends Controller
{
    public function addBarber(Request $request)
    {
        //upload img
        $img = $request->file('img_barber');
        $extension = $img->getClientOriginalExtension();
        $fileName = Str::random(10) . '.' . $extension;
        $uploadPath = env('UPLOAD_PATH') . "/barber/img";

        //create barber
        $barber = Barber::create([
            'img_barber' => $request->file('img_barber')->move($uploadPath, $fileName),
            'name' => $request->name,
            'user_id' => $request->user_id,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        //check jika barber berhasil dibuat
        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'Barber created successfully',
                'data' => $barber
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barber failed to create',
            ], 409);
        }
    }

    public function updateBarber(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        $data = $request->all();

        //check jika ada file img
        if ($request->hasFile('img_barber')) {
            //upload img
            $img = $request->file('img_barber');
            $extension = $img->getClientOriginalExtension();
            $fileName = Str::random(10) . '.' . $extension;
            $uploadPath = env('UPLOAD_PATH') . "/barber/img";

            $data['img_barber'] = $request->file('img_barber')->move($uploadPath, $fileName);
        }

        //update barber
        $barber->update($data);

        //check jika barber berhasil diupdate
        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'Barber updated successfully',
                'data' => $barber
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barber failed to update',
            ], 409);
        }
    }

    public function checkBarberUser($id)
    {
        $barber = Barber::where('user_id', $id)->first();

        //check jika barber berhasil didapatkan
        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'Barber get successfully',
                'data' => $barber
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barber failed to get',
            ], 409);
        }
    }

    public function getBarber($id)
    {
        $barber = Barber::findOrFail($id)->with('userId')->where('id', $id)->first();

        //check jika barber berhasil didapatkan
        if ($barber) {
            return response()->json([
                'success' => true,
                'message' => 'Barber get successfully',
                'data' => $barber
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Barber failed to get',
            ], 409);
        }
    }
}
