<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 12/02/19
 * Time: 19:50
 */

namespace Models;

use Kernel\Models\Model;

class FaqAnswerModel
{

    private static $table = 'faq_answer';
    private $ctId;
    private $ctAnswer;
    private $ctFaqQuestionId;

    use Model {
        __construct as traitConstruct;
    }

    private function __construct()
    {
        return self::traitConstruct(self::$table);
    }

    /**
     * Returns the traitObjects method
     *
     * @return Model instance
     */
    static function objects(): FaqAnswerModel
    {
        return self::traitObjects(self::$table);
    }

    function ifExistsQuery()
    {
        return 'SELECT * FROM ' . $this->tableName . ' WHERE faq_question_id = ' . $this->getCtFaqQuestionId() . ' AND answer LIKE "' .
            $this->getCtAnswer() . '"';
    }

    function fillAttributes($columns): void
    {
        $this->setCtId($columns['id'] ?? '');
        $this->setCtAnswer($columns['answer'] ?? '');
        $this->setCtFaqQuestionId($columns['faq_question_id'] ?? '');
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
    public function getCtAnswer()
    {
        return $this->ctAnswer;
    }

    /**
     * @param mixed $ctAnswer
     */
    public function setCtAnswer($ctAnswer): void
    {
        $this->ctAnswer = $ctAnswer;
    }

    /**
     * @return mixed
     */
    public function getCtFaqQuestionId()
    {
        return $this->ctFaqQuestionId;
    }

    /**
     * @param mixed $ctFaqQuestionId
     */
    public function setCtFaqQuestionId($ctFaqQuestionId): void
    {
        $this->ctFaqQuestionId = $ctFaqQuestionId;
    }

    public function getByQuestionsId($questionId)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' AS t WHERE faq_question_id = ' . $questionId;
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}