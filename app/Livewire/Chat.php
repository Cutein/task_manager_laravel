<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $message;
    public $messages;

    protected $listeners = ['messageReceived' => 'refreshMessages'];

    public function mount()
    {
        $this->messages = Message::latest()->take(10)->get()->reverse();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $this->message,
        ]);

        broadcast(new NewMessage($message))->toOthers();

        $this->messages->push($message);
        $this->message = '';
    }

    public function refreshMessages($newMessage)
    {
        $this->messages->push(Message::find($newMessage['id']));
    }

    public function render()
    {
        return view('livewire.chat');
    }

}
