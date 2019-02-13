<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 07/02/19
 * Time: 01:31
 */

namespace Models;

use Kernel\Models\Model;

class FaqModel
{
    use Model {
        __construct as traitConstruct;
    }

    private static $table = 'faq_question';
    private $ctId;
    private $ctQuestion;
    private $ctClientId;

    private function __construct()
    {
        return self::traitConstruct(self::$table);
    }

    /**
     * Returns the traitObjects method
     *
     * @return Model instance
     */
    static function objects(): FaqModel
    {
        return self::traitObjects(self::$table);
    }

    function ifExistsQuery()
    {
        return 'SELECT * FROM ' . $this->tableName . ' WHERE client_id = ' . $this->getCtClient() . ' AND question LIKE "' .
            $this->getCtQuestion() . '"';
    }

    function fillAttributes($columns): void
    {
        $this->seCttId($columns['id'] ?? '');
        $this->setCtQuestion($columns['question'] ?? '');
        $this->setCtClient($columns['client_id'] ?? '');
    }

    /**
     * @return mixed
     */
    public function getCtId()
    {
        return $this->ctId;
    }

    /**
     * @param mixed $id
     */
    public function seCttId($id): void
    {
        $this->ctId = $id;
    }

    /**
     * @return mixed
     */
    public function getCtQuestion()
    {
        return $this->ctQuestion;
    }

    /**
     * @param mixed $question
     */
    public function setCtQuestion($question): void
    {
        $this->ctQuestion = $question;
    }

    /**
     * @return mixed
     */
    public function getCtClient()
    {
        return $this->ctClientId;
    }

    /**
     * @param mixed $client
     */
    public function setCtClient(int $client): void
    {
        $this->ctClientId = $client;
    }

    /**
     * @param ClientModel $client
     *
     * @return array
     */
    public function getQuestionsByClient(ClientModel $client)
    {
        if ($client->getCtId() > 0) {
            $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE client_id = ' . $client->getCtId();
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function getQuestionsAndAnswersByClient(ClientModel $client)
    {
        if ($client->getCtId() > 0) {
            $sql = 'SELECT t.id, t.question, a.answer FROM ' . $this->tableName . ' as t LEFT JOIN faq_answer as a ON a.faq_question_id = t.id WHERE t.client_id = ' .
                $client->getCtId();
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function getQuestionById($faqId): FaqModel
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $faqId;
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        $this->fillAttributes($stmt->fetch(\PDO::FETCH_ASSOC));

        return $this;
    }
}