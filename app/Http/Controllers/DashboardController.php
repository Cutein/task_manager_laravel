<?php

namespace App\Http\Controllers;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userBoards = Board::where('user_id', $user->id); // Tableros creados por el usuario
        $boardsWithAssignedTasks = Board::whereHas('tasks.users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        }); // Tableros con tareas asignadas al usuario
        $others_boards=0;
        foreach ($boardsWithAssignedTasks->get() as $board) {
            $find = false;
            foreach ($userBoards->get() as $userBoard) {
                if ($board->id == $userBoard->id) {
                    $find = true;
                }
            }
            if (!$find) {
                $others_boards++;
            }
        }

        $userTasks = Task::where('user_id', $user->id); // Tareas creadas por el usuario;
        $assignedTasks = Task::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        }); // Tareas donde el usuario está asignado
        foreach ($userTasks->get() as $task) {
            $assignedTasks = $assignedTasks->where('id', '!=', $task->id);
        }
        // Clonar consultas para contar sin modificar las originales
        $completedTasks = (clone $userTasks)->where('status', 'completada')->count() +
        (clone $assignedTasks)->where('status', 'completada')->count();

        $pendingTasks = (clone $userTasks)->where('status', '!=', 'completada')->count() +
        (clone $assignedTasks)->where('status', '!=', 'completada')->count();
        
        $totalBoards = $userBoards->count() + $others_boards;
        $totalTasks = $userTasks->count() + $assignedTasks->count();

        return view('dashboard', [
            'totalBoards' => $totalBoards,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
