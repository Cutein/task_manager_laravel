<?php

namespace App\Http\Controllers;
use App\Models\Board;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = auth()->user()->boards;
        return view('boards.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        auth()->user()->boards()->create($request->all());
    
        return redirect()->route('boards.index')->with('success', 'Tablero creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        return view('boards.show', compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        return view('boards.edit', compact('board'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $board->update($request->all());
    
        return redirect()->route('boards.index')->with('success', 'Tablero actualizado.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        $board->delete();
        return redirect()->route('boards.index')->with('success', 'Tablero eliminado.');
    }
    
}
