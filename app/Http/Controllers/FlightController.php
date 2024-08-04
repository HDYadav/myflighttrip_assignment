<?php

namespace App\Http\Controllers;

use App\Services\FlightService;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function showSearchForm()
    {
        return view('flights.search');
    }

    public function searchFlights(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'origin' => 'required|string|max:3',
        //     'destination' => 'required|string|max:3',
        //     'departure_date' => 'required|date|after_or_equal:today',
        //     'passengers' => 'required|integer|min:1',
        //     'class' => 'required|string|in:ECONOMY,BUSINESS,FIRST'
        // ]);

       

        // Here you would call your flight service to search for flights
        // $flights = $this->flightService->searchFlights($request->all());

        // For now, we will return the request data for demonstration purposes
        return response()->json($request->all());
    }


    public function showFlights(Request $request)
    {
        
        // Fetch the data from the flight service
        $flights = $this->flightService->searchFlights($request);

        // Decode the JSON response
        $data = json_decode(json_encode($flights), true);
        $flights = $data['searchResult']['tripInfos']['ONWARD'];

        

        return view('flights.index', compact('flights'));
    }




     


}