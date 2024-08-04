<?php
 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlightService
{
    public function searchFlights($request)
    {
    //   dd($request);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'apikey' => '611630701c324e-d809-4417-bec7-62963cddadd5',
        ])->post('https://apitest.tripjack.com/fms/v1/air-search-all', [
            'searchQuery' => [
                'cabinClass' => $request->class,
                'paxInfo' => [
                    'ADULT' => $request->adult,
                    'CHILD' =>  $request->child,
                    'INFANT' => '0',
                ],
                'routeInfos' => [
                    [
                        'fromCityOrAirport' => [
                            'code' => $request->origin,
                        ],
                        'toCityOrAirport' => [
                            'code' => $request->destination,
                        ],
                        'travelDate' =>  $request->departure_date,
                    ],
                ],
                'searchModifiers' => [
                    'isDirectFlight' => true,
                    'isConnectingFlight' => false,
                ],
            ],
        ]);

        return $response->json();
    }
}
