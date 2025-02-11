<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);
    
        $task->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(), // Guarda el usuario autenticado
        ]);
    
        return redirect()->route('tasks.show', $task)->with('success', 'Comentario agregado.');
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
