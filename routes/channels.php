<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('chat-channel', function ($user) {
    return $user != null; // Solo usuarios autenticados pueden acceder
});

