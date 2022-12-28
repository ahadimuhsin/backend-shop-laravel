<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/province')->collect();
        // dd($daftarProvinsi);

        for($i=0; $i < count($daftarProvinsi["rajaongkir"]["results"]); $i++){
            Province::create([
                'province_id' => $daftarProvinsi["rajaongkir"]["results"][$i]['province_id'],
                'name' => $daftarProvinsi["rajaongkir"]["results"][$i]['province']
            ]);
            // dd($daftarKota);
        }

        $daftarKota =  Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/city')->collect();

        for($j=0; $j < count($daftarKota["rajaongkir"]["results"]); $j++){
            // dd($daftarKota["rajaongkir"]["results"])[$j];
            City::create([
                "province_id" => $daftarKota["rajaongkir"]["results"][$j]["province_id"],
                "city_id" => $daftarKota["rajaongkir"]["results"][$j]["city_id"],
                "name" => $daftarKota["rajaongkir"]["results"][$j]["city_name"],
                "type" => $daftarKota["rajaongkir"]["results"][$j]["type"]
            ]);
        }
    }
}
