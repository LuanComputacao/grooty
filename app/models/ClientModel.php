<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 19/12/18
 * Time: 15:46
 */

namespace Models;

use Kernel\Models\{Model};

class ClientModel
{
    use Model {
        __construct as traitConstruct;
    }

    private static $table = 'client';
    private $ctId;
    private $ctName;
    private $ctSelfServUrl;
    private $ctSocket;
    private $ctTokenApi;
    private $ctSiteUrl;
    private $ctEmail;
    private $ctWelcomePage;

    /**
     * @return mixed
     */
    public function getCtWelcomePage()
    {
        return $this->ctWelcomePage;
    }

    /**
     * @param mixed $ctWelcomePage
     */
    public function setCtWelcomePage($ctWelcomePage): void
    {
        $this->ctWelcomePage = $ctWelcomePage;
    }

    private function __construct()
    {
        $this->traitConstruct(self::$table);
    }

    /**
     * @return Model
     */
    public static function objects(): ClientModel
    {
        return self::traitObjects(self::$table);
    }

    /**
     * @return mixed
     */
    public function getCtId()
    {
        return $this->ctId;
    }

    /**
     * @param mixed $ctId
     */
    public function setCtId($ctId): void
    {
        $this->ctId = $ctId;
    }

    /**
     * @return mixed
     */
    public function getCtSocket()
    {
        return $this->ctSocket;
    }

    /**
     * @param mixed $ctSocket
     */
    public function setCtSocket(string $ctSocket): void
    {
        $this->ctSocket = $ctSocket;
    }

    /**
     * @return mixed
     */
    public function getCtName()
    {
        return $this->ctName;
    }

    /**
     * @param mixed $ctName
     */
    public function setCtName(string $ctName): void
    {
        $this->ctName = $ctName;
    }

    public function getByCtName(string $ctNAme): ClientModel
    {
        $sql = 'SELECT t.* FROM ' . $this->tableName . ' as t WHERE name=\'' . $ctNAme . '\'';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->fillAttributes($result);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCtSelfServUrl()
    {
        return $this->ctSelfServUrl;
    }

    /**
     * @param mixed $ctSelfServUrl
     */
    public function setCtSelfServUrl(string $ctSelfServUrl): void
    {
        $this->ctSelfServUrl = $ctSelfServUrl;
    }

    /**
     * @return mixed
     */
    public function getCtTokenApi()
    {
        return $this->ctTokenApi;
    }

    /**
     * @param mixed $ctTokenApi
     */
    public function setCtTokenApi(string $ctTokenApi): void
    {
        $this->ctTokenApi = $ctTokenApi;
    }

    /**
     * @return mixed
     */
    public function getCtSiteUrl()
    {
        return $this->ctSiteUrl;
    }

    /**
     * @param mixed $ctSiteUrl
     */
    public function setCtSiteUrl(string $ctSiteUrl): void
    {
        $this->ctSiteUrl = $ctSiteUrl;
    }

    /**
     * @return mixed
     */
    public function getCtEmail()
    {
        return $this->ctEmail;
    }

    /**
     * @param mixed $ctEmail
     */
    public function setCtEmail($ctEmail): void
    {
        $this->ctEmail = $ctEmail;
    }

    function ifExistsQuery()
    {
        return 'SELECT t.* FROM ' . $this->tableName . ' as t WHERE name=\'' . $this->ctName . '\'';
    }

    public function getByCtSiteUrlAndCtTokenApi(string $siteUrl, string $tokenApi)
    {
        $sql = 'SELECT t.* FROM ' . $this->tableName . ' AS t ' . 'WHERE site_url=\'' . $siteUrl . '\' AND token_api=\'' . $tokenApi . '\'';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->fillAttributes($result);

        return $this;
    }

    /**
     * @param $columns
     */
    public function fillAttributes($columns): void
    {
        $this->setCtId($columns['id'] ?? '');
        $this->setCtName($columns['name'] ?? '');
        $this->setCtSelfServUrl($columns['self_serv_url'] ?? '');
        $this->setCtSocket($columns['socket'] ?? '');
        $this->setCtTokenApi($columns['token_api'] ?? '');
        $this->setCtSiteUrl($columns['site_url'] ?? '');
        $this->setCtWelcomePage($columns['welcome_page'] ?? '');
    }

    public function getWelcomePage(): string
    {
        $sql = 'SELECT t.welcome_page FROM ' . $this->tableName . '  AS t WHERE name LIKE \'' . $this->getCtName() . '\'';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getByCtId($id)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' AS t WHERE id = ' . $id;
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->fillAttributes($result);

        return $this;
    }
}
