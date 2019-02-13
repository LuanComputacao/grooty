<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 05/02/19
 * Time: 15:17
 */

namespace Services;

use Factories\ClientFactory;
use Models\ClientModel;

class ClientService
{
    /**
     * Check the validity of the Client data and register or not a new one
     *
     * @param string $name
     * @param string $selfServUrl
     * @param string $socket
     * @param string $siteUrl
     * @param string $email
     * @param string $welcomePage
     *
     * @return ClientModel|null
     */
    public static function registerClient(
        string $name,
        string $selfServUrl,
        string $socket,
        string $siteUrl,
        string $email,
        string $welcomePage
    ) {
        $clientNew = null;
        if ($name != '' &&
            $selfServUrl != '' &&
            $socket != '' &&
            $siteUrl != '' &&
            $email != '' &&
            $welcomePage != ''
        ) {
            $clientNew = ClientFactory::create(
                $name,
                $selfServUrl,
                $socket,
                $siteUrl,
                $email,
                $welcomePage
            );
            $clientNew->save();
        }

        return $clientNew;
    }

    /**
     * @param ClientModel $client
     *
     * @return string
     */
    public static function getWelcomeService($client): string
    {
        return html_entity_decode($client->getCtWelcomePage());
    }

    public static function getPrintableData()
    {
        $clients = ClientModel::objects()->getAll();
        foreach ($clients as $key => $client) {
            $clients[$key]['printable_welcome_page'] = html_entity_decode($client['welcome_page']);
        }

        return $clients;
    }
}