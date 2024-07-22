<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    public function searchFlights (Request $request) {
        $origem = $request->input('origem');
        $destino = $request->input('destino');
        $partida = $request->input('partida');
        $regresso = $request->input('regresso');
        $passageiros = $request->input('passageiros');

        $response = Http::withToken($this->getToken())->get('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            'originLocationCode' => $origem,
            'destinationLocationCode' => $destino,
            'departureDate' => $partida,
            'returnDate' => $regresso,
            'adults' => $passageiros,
            'max'=> 5 
        ]);
        if ($response->successful()) {
            $flights = json_decode($response->getBody(), true);
            $filteredFlights = $this->filterFlights($flights['data']);
            $cacheKey = 'flight-offers-' . uniqid();
            Cache::put($cacheKey, $flights['data'], 300);
            return response()->json([
                'flights' => $filteredFlights,
                'dictionaries' => $flights['dictionaries'] ?? null,
                'cacheKey' => $cacheKey
            ]);
        } else {
            $status = $response->status();
            $errorBody = $response->body();
            return response()->json(['error' => 'Failed to fetch flight offers', 'status' => $status, 'details' => $errorBody], $status);
        }
    }

    private function filterFlights($flights)
    {
        return array_map(function ($flight) {
            return [
                'id' => $flight['id'],
                'source' => $flight['source'],
                'price' => $flight['price'],
                'itineraries' => array_map(function ($itinerary) {
                    return [
                        'duration' => $itinerary['duration'],
                        'segments' => array_map(function ($segment) {
                            return [
                                'departure' => $segment['departure'],
                                'arrival' => $segment['arrival'],
                                'carrierCode' => $segment['carrierCode'],
                                'number' => $segment['number'],
                                'aircraft' => $segment['aircraft']['code'],
                                'duration' => $segment['duration']
                            ];
                        }, $itinerary['segments'])
                    ];
                }, $flight['itineraries'])
            ];
        }, $flights);
    }

    public function getToken()
    {
        $response = Http::asForm()->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => env('AMADEUS_CLIENT_ID'),
            'client_secret' => env('AMADEUS_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['access_token'];
        } else {
            return null;
        }
    }

    public function getCache() {
        return Cache::get('flight-offers-66930679a6052');
    }
}
