<?php

namespace App\Http\Controllers\API;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservaController extends Controller
{
    // Exibe uma lista de todas as reservas
    public function index()
    {
        $reservas = Reserva::all();
        return view('reservas.index', compact('reservas'));
    }

    // Exibe o formulário para criar uma nova reserva
    public function create()
    {
        return view('reservas.create');
    }

    // Armazena uma nova reserva no banco de dados
    public function cccccc(Request $request)
    {
        try {
            $key = $request->header('key');
            if ($key != env('API_KEY')) {
                throw new \Exception("API Key inválida", 1);
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
            return response()->json(["msg" => "Reserva criada com sucesso"], 200);            
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    // Exibe uma reserva específica
    public function show($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    // Exibe o formulário para editar uma reserva existente
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('reservas.edit', compact('reserva'));
    }

    // Atualiza uma reserva específica no banco de dados
    public function update(Request $request, $id)
    {
        try {
            $key = $request->header('key');
            if ($key != env('API_KEY')) {
                throw new \Exception("API Key inválida", 1);
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

            $reserva = Reserva::findOrFail($id);
            $reserva->update($request->all());
            return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    // Remove uma reserva específica do banco de dados
    public function destroy($id)
    {
        try {
            $key = request()->header('key');
            if ($key != env('API_KEY')) {
                throw new \Exception("API Key inválida", 1);
            }

            $reserva = Reserva::findOrFail($id);
            $reserva->delete();
            return redirect()->route('reservas.index')->with('success', 'Reserva deletada com sucesso!');
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }
}
