<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class UpdateTaskStatus extends Component
{
    public $task;
    public $status;

    protected $rules = [
        'status' => 'required|in:pausada,en_proceso,completada',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    public function updated($property)
    {
        if ($property === 'status') {
            $this->validate();
            $this->task->update(['status' => $this->status]);
            $this->dispatch('statusUpdated');
        }
    }

    public function render()
    {
        return view('livewire.update-task-status');
    }
}
