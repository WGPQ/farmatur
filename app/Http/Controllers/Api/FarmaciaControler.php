<?php

namespace App\Http\Controllers\Api;

use App\Farmacias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Farmacia as FarmaciasResource;
class FarmaciaControler extends Controller
{
    /**
     * Get outlet listing on Leaflet JS geoJSON data structure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $farma = Farmacias::all();

        $geoJSONdata = $farma->map(function ($farma) {
            return [
                'type'       => 'Feature',
                'properties' => new FarmaciasResource($farma),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $farma->longitude,
                        $farma->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
   
}
