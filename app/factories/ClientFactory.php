<?php

namespace Factories;

use Models\ClientModel;

class ClientFactory
{
    /**
     * Create a new Client Instance
     *
     * @param string $name
     * @param string $selfServUrl
     * @param string $socket
     * @param string $siteUrl
     * @param string $email
     * @param string $welcomePage
     *
     * @return ClientModel
     */
    public static function create(
        string $name,
        string $selfServUrl,
        string $socket,
        string $siteUrl,
        string $email,
        string $welcomePage
    ) {
        $client = ClientModel::objects();
        $client->setCtName($name);
        $client->setCtSelfServUrl($selfServUrl);
        $client->setCtSocket($socket);
        $client->setCtTokenApi(self::buildToken($name));
        $client->setCtSiteUrl($siteUrl);
        $client->setCtEmail($email);
        $client->setCtWelcomePage(htmlentities($welcomePage));

        return $client;
    }

    private static function buildToken(string $name): string
    {
        return md5($name . time());
    }
}
