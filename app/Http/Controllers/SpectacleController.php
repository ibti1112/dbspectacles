<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spectacle;

class SpectacleController extends Controller
{
    public function index()
    {
        $spectacles = Spectacle::all();
        return response()->json(['data' => $spectacles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpiece' => 'required|exists:pieces,id',
            'datespectacle' => 'required|date',
            'idsalle' => 'required|exists:salles,id',
        ]);

        $spectacle = Spectacle::create($request->all());
        return response()->json(['message' => 'Spectacle ajouté avec succès', 'data' => $spectacle], 201);
    }

    public function show(int $id)
    {
        $spectacle = Spectacle::findOrFail($id);
        return response()->json(['data' => $spectacle]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'idpiece' => 'required|exists:pieces,id',
            'datespectacle' => 'required|date',
            'idsalle' => 'required|exists:salles,id',
        ]);

        $spectacle = Spectacle::findOrFail($id);
        $spectacle->update($request->all());
        return response()->json(['message' => 'Spectacle mis à jour avec succès', 'data' => $spectacle]);
    }

    public function destroy(int $id)
    {
        $spectacle = Spectacle::findOrFail($id);
        $spectacle->delete();
        return response()->json(['message' => 'Spectacle supprimé avec succès']);
    }
}
