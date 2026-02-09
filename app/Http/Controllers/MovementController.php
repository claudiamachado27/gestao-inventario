<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movement;

class MovementController extends Controller
{
    /**
     * Guarda um novo movimento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'categoria_id' => 'required|exists:categoria,id',
            'data' => 'required|date',
        ]);

        Movement::create($validated);

        return redirect()->route('dashboard')->with('success', 'Movimento adicionado com sucesso!');
    }

    /**
     * Atualiza um movimento existente
     */
    public function update(Request $request, $id)
    {
        $movement = Movement::findOrFail($id);

        $validated = $request->validate([
            'edit_tipo' => 'required|string',
            'edit_descricao' => 'required|string|max:255',
            'edit_valor' => 'required|numeric',
            'edit_categoria_id' => 'required|exists:categoria,id',
            'edit_data' => 'required|date',
        ]);

        // Mapeia os nomes dos campos do formulário para as colunas da base de dados
        $movement->update([
            'tipo' => $validated['edit_tipo'],
            'descricao' => $validated['edit_descricao'],
            'valor' => $validated['edit_valor'],
            'categoria_id' => $validated['edit_categoria_id'],
            'data' => $validated['edit_data'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Movimento atualizado com sucesso!');
    }

    /**
     * Exibe o formulário de criar movimento
     */
    public function create()
    {
        return view('movements.create');
    }

    /**
     * Exibe o formulário de editar movimento
     */
    public function edit(Request $request)
    {
        $movements = Movement::orderBy('data', 'desc')->get();
        $categories = \App\Models\Category::orderBy('nome')->get();
        $selectedMovement = null;

        if ($request->filled('id')) {
            $selectedMovement = Movement::find($request->id);
        }

        $allMovements = $movements;
        return view('movements.edit', compact('movements', 'allMovements', 'categories', 'selectedMovement'));
    }

    /**
     * Exibe a confirmação de apagar movimento
     */
    public function delete(Request $request)
    {
        $query = Movement::orderBy('data', 'desc');
        $selectedMovement = null;

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('descricao', 'like', "%{$searchTerm}%")
                    ->orWhere('valor', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('id')) {
            $selectedMovement = Movement::find($request->id);
        }

        $movements = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'movements' => $movements,
                'selectedMovement' => $selectedMovement ? $selectedMovement->load('category') : null
            ]);
        }

        return view('movements.delete', compact('movements', 'selectedMovement'));
    }

    /**
     * Remove um movimento da base de dados
     */
    public function destroy($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->delete();

        return redirect()->route('dashboard')->with('success', 'Movimento apagado com sucesso!');
    }
}
