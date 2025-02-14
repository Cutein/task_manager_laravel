<?php

namespace App\Http\Controllers;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $boards = Board::where('user_id', $user->id)->get();; // Tableros creados por el usuario
        $boardsWithAssignedTasks = Board::whereHas('tasks.users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();; // Tableros con tareas asignadas al usuario
        // Quitar los tableros que ya existen en $userBoards
        $boardsWithAssignedTasks = $boardsWithAssignedTasks->reject(function ($board) use ($boards) {
            return $boards->contains('id', $board->id);
        });
        return view('boards.index', compact('boards','boardsWithAssignedTasks'));
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
        $user = auth()->user();
        $assignedTasks = Task::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();
        return view('boards.show', compact('board', 'assignedTasks'));
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
