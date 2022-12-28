<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Provinsi',
            'data' => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $city = City::where('province_id', $request->province_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Kota Berdasarkan Provinsi',
            'data' => $city
        ]);
    }

    public function checkOngkir(Request $request)
    {
        // $cost = $daftarKota =  Http::withHeaders([
        //     'key' => env('RAJAONGKIR_API_KEY')
        // ])->get('https://api.rajaongkir.com/starter/cost')->collect();
        $cost = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://api.rajaongkir.com/starter/cost',
            [
            'origin' => 113,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->collect();

        return response()->json([
            'success' => true,
            'message' => 'Ongkir Dari Kurir '.strtoupper($request->courier),
            'data' => $cost
        ]);
    }
}
