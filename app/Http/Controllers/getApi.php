<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getApi extends Controller
{
    public function index(Request $request) {
        
        if ($request->origin && $request->destination && $request->weight && $request->courier){
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier;    

                    
        $response = Http::asForm()->withHeaders([
            'key' => '9509e150e27ab2f82b6a137353b85af3'
            ])->post('https://api.rajaongkir.com/starter/cost',[
                'origin' => $origin ,
                'destination' =>  $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            $cekongkir = $response['rajaongkir']['results'][0]['costs'];
        }
        else{
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
            $cekongkir = null ;    
        }

            $provinsi = Provinsi::all();
            return view('home', compact('provinsi', 'cekongkir'));
        }
        
        public function ajax($id){
            $kota = Kota::where('province_id','=', $id)->pluck('city_name','id');
            return json_encode($kota);
        }
    }
    