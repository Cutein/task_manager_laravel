<div class="py-12">
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-4 flex">
            <!-- Lista de Usuarios para Chatear -->
            <div class="w-1/3 border-r p-2">
                <h2 class="text-lg font-bold mb-2">Usuarios</h2>
                @foreach($users as $user)
                    <div class="p-2 border-b cursor-pointer hover:bg-blue-200 {{ $selectedChatUserId === $user['id'] ? 'bg-green-300' : '' }}"
                        wire:click="selectChat({{ $user['id'] }})">
                        <strong>{{ $user['name'] }}</strong>
                        @if ($user['unread_messages_count'] > 0)
                            <span class="bg-red-500 text-white px-2 py-1 rounded-full">
                                {{ $user['unread_messages_count'] }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <!-- Chat de Mensajes -->
            <div class="w-2/3 p-2">
                <div class="h-64 overflow-y-auto border-b mb-4 p-2" id="chat-box">
                    @foreach($messages as $msg)
                        <div class="mb-3 {{ $msg['user_id'] != Auth::id() ? 'text-left' : 'text-right' }}">
                            <span class="{{ $msg['user_id'] != Auth::id() ? '' : 'bg-green-200 rounded p-2' }}"> <strong>{{ $msg['user']['name'] ?? 'Invitado' }}:</strong> {{ $msg['message'] }}</span>
                        </div>
                    @endforeach
                </div>
    
                <div class="flex">
                    <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                        class="w-full border rounded p-2" placeholder="Escribe un mensaje...">
                    <button wire:click="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    function scrollToBottom() {
        setTimeout(() => {
            let chatBox = document.getElementById("chat-box");
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }, 100);
    }

    document.addEventListener("DOMContentLoaded", scrollToBottom);

    window.addEventListener('scrollToBottom', scrollToBottom);

    document.addEventListener('livewire:updated', () => {
        scrollToBottom();
    });

    document.addEventListener('livewire:load', () => {
        scrollToBottom();
    });
</script>



