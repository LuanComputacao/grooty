<?php

namespace Controllers;

use Kernel\Conf;
use Kernel\mvcs\Controller;
use Kernel\mvcs\View;
use Models\ClientModel;

class HomeController extends Controller
{

    function get()
    {
        $client = ClientModel::objects()->getByCtName('Luan Santos');

        $args = [
            'client' => $client,
            'cors' => Conf::getConf('allowed_domains')['support'],
            'company_name' => 'Target Clock',
        ];
        View::render('index', $args);
    }

}
