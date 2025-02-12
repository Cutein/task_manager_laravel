<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function users()
    {
        $users = User::paginate(10); // Paginación de 10 usuarios por página
        return view('admin.users', compact('users'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'is_active' => 'required|in:0,1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => (int) $request->is_active,
        ]);
    
        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }
    public function boards()
    {
        $boards = Board::with(['user', 'tasks'])->get(); // Trae usuarios y tareas relacionadas
        return view('admin.boards', compact('boards'));
    }

    public function editBoard(Board $board)
    {
        return view('admin.edit-boards', compact('board'));
    }

    public function updateBoard(Request $request, Board $board)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $board->update($request->all());

        return redirect()->route('admin.boards')->with('success', 'Tablero actualizado correctamente.');
    }

    public function deleteBoard(Board $board)
    {
        $board->delete();
        return redirect()->route('admin.boards')->with('success', 'Tablero eliminado correctamente.');
    }

    public function tasks()
    {
        $tasks = Task::with(['users', 'board'])->get(); // Carga usuarios asignados y el tablero
        return view('admin.tasks', compact('tasks'));
    }
    public function editTask(Task $task)
    {
        $users = \App\Models\User::all(); // Obtener todos los usuarios
        return view('admin.edit-tasks', compact('task','users'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $request->merge([
            'users' => explode(',', $request->users[0] ?? '')
        ]);
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
        ]);

        if ($request->has('users')) {
            $task->users()->sync($request->users); // Asigna los usuarios
            // Enviar notificaciones a los usuarios asignados
            foreach ($request->users as $userId) {
                $user = \App\Models\User::find($userId);
                if ($user) {
                    $user->notify(new \App\Notifications\TaskAssignedNotification($task));
                }
            }
        }

        return redirect()->route('admin.tasks')->with('success', 'Tarea actualizada correctamente.');
    }

    
    public function deleteTask(Task $task)
    {

        $task->delete(); // Elimina la tarea

        return redirect()->route('admin.tasks', $task->board)
                        ->with('success', 'Tarea eliminada correctamente.');
    }
}
