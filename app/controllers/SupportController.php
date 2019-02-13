<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 19/12/18
 * Time: 11:08
 */

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\View;
use Services\WelcomeService;

class SupportController extends Controller
{

    function post()
    {
        $origin = $_SERVER["HTTP_ORIGIN"] ?? '';
        $token = $_POST['token'] ?? '';

        $welcomeService = WelcomeService::getWelcomeService($origin, $token);

        header("Access-Control-Allow-Origin: *");
        View::responseJson([
            'app' => 'faq',
            'view' => $welcomeService,
            'success' => ($welcomeService != ''),
        ]);
    }

}