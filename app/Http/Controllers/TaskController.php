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
    public function create(Board $board, Task $task)
    {
        $users = \App\Models\User::all(); // Obtener todos los usuarios
        return view('tasks.create', compact('board','users','task'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Board $board)
    {
        $request->merge([
            'users' => explode(',', $request->users[0] ?? ''),
            'tags' => explode(',', $request->tags[0] ?? '')
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'due_date' => 'nullable|date',
            'users' => 'array', // Validar usuarios
            'users.*' => 'exists:users,id', // Cada usuario debe existir
        ]);
    
        $task = $board->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags, // Laravel lo convertirá automáticamente a JSON
            'due_date' => $request->due_date,
            'user_id' =>  auth()->id(),
        ]);

        // Asignar usuarios a la tarea
        if ($request->users[0] !== '') {
            $task->users()->sync($request->users);
              // Enviar notificaciones a los usuarios asignados
            foreach ($request->users as $userId) {
                $user = \App\Models\User::find($userId);
                if ($user) {
                    $user->notify(new \App\Notifications\TaskAssignedNotification($task));
                }
            }
        }

        return redirect()->route('boards.show', $board)->with('success', 'Tarea creada correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('users'); // Cargar usuarios asignados

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
        $users = \App\Models\User::all(); // Obtener todos los usuarios

        return view('tasks.edit', compact('task', 'users'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->merge([
            'users' => explode(',', $request->users[0] ?? ''),
            'tags' => explode(',', $request->tags[0] ?? '')
        ]);
        // Verificar si el usuario es dueño del tablero al que pertenece la tarea
        if ($task->board->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'due_date' => 'nullable|date',
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
        ]);

        if ($request->users[0] !== '') {
            $task->users()->sync($request->users); // Asigna los usuarios
            // Enviar notificaciones a los usuarios asignados
            foreach ($request->users as $userId) {
                $user = \App\Models\User::find($userId);
                if ($user) {
                    $user->notify(new \App\Notifications\TaskAssignedNotification($task));
                }
            }
        }
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
        $user = auth()->user();
        $userTasks = Task::where('user_id', $user->id); // Tareas creadas por el usuario;
        $assignedTasks = Task::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        }); // Tareas donde el usuario está asignado
        foreach ($userTasks->get() as $task) {
            $assignedTasks = $assignedTasks->where('id', '!=', $task->id);
        }

        return view('tasks.index', [
            'userTasks' => $userTasks->get(),
            'assignedTasks' => $assignedTasks->get(),
        ]);
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:nueva,en_proceso,pausada,completada',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Estado de la tarea actualizado.');
    }
    public function deleteTask(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks')->with('success', 'Tarea eliminada correctamente.');
    }
}
