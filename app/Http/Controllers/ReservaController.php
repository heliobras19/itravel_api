<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
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

        Reserva::create($request->all());
        return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
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
    }

    // Remove uma reserva específica do banco de dados
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva deletada com sucesso!');
    }
}
