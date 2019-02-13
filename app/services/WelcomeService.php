<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 05/02/19
 * Time: 15:27
 */

namespace Services;

use Models\ClientModel;

class WelcomeService
{
    public static function getWelcomeService(string $origin, string $token): string
    {
        $client = ClientModel::objects()->getByCtSiteUrlAndCtTokenApi($origin, $token);

        return ClientService::getWelcomeService($client);
    }

}