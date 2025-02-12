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

    public function boards()
    {
        $boards = Board::all();
        return view('admin.boards', compact('boards'));
    }

    public function tasks()
    {
        $tasks = Task::all();
        return view('admin.tasks', compact('tasks'));
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
    
}
