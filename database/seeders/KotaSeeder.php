<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Kota;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '9509e150e27ab2f82b6a137353b85af3'
        ])->get('https://api.rajaongkir.com/starter/city');
        $kota = $response['rajaongkir']['results'];

        foreach($kota as $kotaa){
            $data_kotaa[] = [
                'id' => $kotaa['city_id'],
                'province_id' => $kotaa['province_id'],
                'type' => $kotaa['type'],
                'city_name' => $kotaa['city_name'],
                'postal_code' => $kotaa['postal_code']
            ];
        }
        Kota::insert($data_kotaa);
    }
}
