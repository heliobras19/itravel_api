<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()  {
        $reservas = Reserva::all();
        return view('reservas.index');
    }

    public function storeAPI(Request $request)  {
        try {
            $key = $request->header('key');
            if ($key != env('API_KEY')) {
                throw new \Exception("API Key invalida", 1);
                
            }
            $request->validate([
            'partida' => 'required',
            'destino' => 'required',
            'data_ida' => 'required',
            'data_regresso' => 'required',
            'num_passageiros' => 'required',
            'nome_responsavel' => 'required',
            'contato_responsavel' => 'required',
            'amadeus_data' => 'required'
        ]);
        $reserva = Reserva::create($request->all());
        return response()->json($reserva);
        } catch (\Exception $th) {
           return response()->json($th->getMessage(), 400);
        }
    }

    public function store(Request $request) {
        $this->storeAPI($request);
        return view('');
    }

    public function create () {
        
    }
}
