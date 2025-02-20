<div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-4">
    <div class="h-64 overflow-y-auto border-b mb-4 p-2" id="chat-box">
        @foreach($messages as $msg)
            <div class="mb-2">
                <strong>{{ $msg->user->name }}:</strong> {{ $msg->message }}
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

<script>
    Livewire.on('messageReceived', () => {
        let chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>
