<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 05/02/19
 * Time: 11:23
 */

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\View;
use Services\ClientService;

class ManagerRegisterController extends Controller
{
    function get()
    {
        View::render('admin/register_client', [
            'clients' => $clients = ClientService::getPrintableData(),
        ]);
    }

    function post()
    {
        $clientNew = null;
        $name = $_POST['name'] ?? '';
        $selfServUrl = $_POST['selfServUrl'] ?? '';
        $socket = $_POST['socket'] ?? '';
        $siteUrl = $_POST['siteUrl'] ?? '';
        $email = $_POST['email'] ?? '';
        $welcomePage = $_POST['welcomePage'] ?? '';

        $clientNew = ClientService::registerClient($name, $selfServUrl, $socket, $siteUrl, $email, $welcomePage);

        if (($clientNew != null)) {
            View::responseJson([
                'success' => 'true',
                'client' => [
                    'created' => $clientNew->wasCreated(),
                    'name' => $clientNew->getCtName(),
                    'selfServUrl' => $clientNew->getCtSelfServUrl(),
                    'socket' => $clientNew->getCtSocket(),
                    'siteUrl' => $clientNew->getCtSiteUrl(),
                    'email' => $clientNew->getCtEmail(),
                    'welcomePage' => $clientNew->getCtWelcomePage(),
                ],
            ]);
        } else {
            View::responseJson([
                'success' => false,
                'client' => null,
            ]);
        }
    }
}
