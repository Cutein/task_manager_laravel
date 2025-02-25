<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $message = ''; // El mensaje es un string
    public $messages = []; // Inicializamos como array vacío
    public $selectedChatUserId = null;
    public $users = []; // Lista de usuarios disponibles para chatear

    protected $listeners = ['messageReceived' => 'refreshMessages'];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers(){
        $this->users = User::where('id', '!=', Auth::id()) // Excluir al usuario autenticado
            ->withCount([
                'unreadMessages as unread_messages_count'
            ])
            ->get()
            ->toArray();
    }
    
    
    public function selectChat($userId)
    {
        $this->selectedChatUserId = $userId;

        // 🔥 Solo marcar como leído si el usuario actual es el receptor
        Message::where('user_id', $userId)
            ->where('receiver_id', Auth::id()) 
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // 🔥 Recargar mensajes
        $this->messages = Message::where(function ($query) use ($userId) {
                $query->where('user_id', Auth::id())->where('receiver_id', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('receiver_id', Auth::id());
            })
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'user_id' => $message->user_id,
                    'user' => [
                        'name' => $message->user->name ?? 'Invitado'
                    ],
                    'message' => $message->message,
                    'created_at' => $message->created_at->toISOString(),
                ];
            })
            ->toArray();

        // 🔥 Recargar la lista de usuarios para actualizar el contador de mensajes no leídos
        $this->loadUsers();

        $this->dispatch('refresh');
        $this->dispatch('scrollToBottom');
    }


    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:255',
        ]);

        if (!$this->selectedChatUserId) return;

        $message = Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $this->selectedChatUserId,
            'message' => $this->message,
            'is_read' => false
        ]);

        broadcast(new NewMessage($message))->toOthers();

        $this->messages[] = [
            'id' => $message->id,
            'user_id' => $message->user_id,
            'user' => [
                'name' => $message->user->name ?? 'Invitado', // Se obtiene el nombre del usuario
            ],
            'message' => $message->message,
            'created_at' => $message->created_at->toISOString(),
        ];
        
        $this->message = '';
        $this->loadUsers(); // Actualizar el contador de mensajes no leídos
    }

    public function refreshMessages($newMessage)
    {
        // Verificar si el usuario tiene un chat seleccionado
        if ($this->selectedChatUserId === null) {
            return;
        }
    
        // Verificar si el mensaje pertenece al chat actualmente seleccionado
        if (
            ($newMessage['user_id'] == $this->selectedChatUserId && $newMessage['receiver_id'] == Auth::id()) ||
            ($newMessage['receiver_id'] == $this->selectedChatUserId && $newMessage['user_id'] == Auth::id())
        ) {
            $this->messages[] = Message::with('user')->find($newMessage['id'])->toArray();
        }
    
        // 🔥 Recargar la lista de usuarios para actualizar los contadores
        $this->loadUsers();
        $this->dispatch('scrollToBottom');
    }
    

    public function render()
    {
        return view('livewire.chat', [
            'messages' => $this->messages,
            'users' => $this->users,
        ]);
    }


}
