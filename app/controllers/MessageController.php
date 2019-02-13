<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 19/12/18
 * Time: 15:13
 */

namespace Controllers;

use Kernel\mvcs\{Controller, View};

class MessageController extends Controller
{
    function post()
    {
        $message = $_POST['message'] ?? '';
        $token = $_POST['token'] ?? '';

        View::responseJson([
            'success' => 'ok',
            'status' => 'sent',
        ]);
    }
}