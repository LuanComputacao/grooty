<?php

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\View;

class ChatController extends Controller
{

    function get()
    {
        $this->mountChat();
    }

    function mountChat()
    {
        $messages = [
            [
                'side' => 1,
                'user_initials' => 'Gr',
                'message' => 'Olá, como posso te ajudar',

            ],
        ];

        $view = View::mount('partials/_chat', [
            'messages' => $messages,
            'clerk' => 'Grooty',
        ]);

        View::responseJson([
            'success' => 'ok',
            'view' => $view,
        ]);
    }

    function post()
    {
        $this->mountChat();
    }
}