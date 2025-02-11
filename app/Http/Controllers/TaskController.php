<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Board $board)
    {
        $tasks = $board->tasks; // Obtiene todas las tareas del tablero
        return view('tasks.index', compact('board', 'tasks'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Board $board)
    {
        return view('tasks.create', compact('board'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Board $board)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $board->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('boards.show', $board)->with('success', 'Tarea creada correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Verificar si el usuario es dueño del tablero al que pertenece la tarea
        if ($task->board->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta tarea.');
        }
    
        return view('tasks.edit', compact('task'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Verificar si el usuario es dueño del tablero al que pertenece la tarea
        if ($task->board->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea.');
        }
    
        // Validar los datos
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Actualizar la tarea
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Tarea actualizada correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */public function destroy(Task $task)
    {
        // Cargar explícitamente la relación
        $task->load('board');

        if (!$task->board) {
            return redirect()->route('dashboard')->with('error', 'No se encontró el tablero asociado a esta tarea.');
        }

        if ($task->board->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea.');
        }

        $task->delete(); // Elimina la tarea

        return redirect()->route('boards.show', $task->board)
                        ->with('success', 'Tarea eliminada correctamente.');
    }

    

    public function allTasks()
    {
        $tasks = auth()->user()->boards()->with('tasks')->get()->pluck('tasks')->flatten();
        return view('tasks.index', compact('tasks'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:nueva,en_proceso,pausada,completada',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Estado de la tarea actualizado.');
    }

}
