<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '9509e150e27ab2f82b6a137353b85af3'
        ])->get('https://api.rajaongkir.com/starter/province');
        $provinsi = $response['rajaongkir']['results'];

        foreach($provinsi as $propinsi){
            $data_propinsi[] = [
                'id' => $propinsi['province_id'],
                'province' => $propinsi['province']
            ];
        }
        Provinsi::insert($data_propinsi);
    }
}
