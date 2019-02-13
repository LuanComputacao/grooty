<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 12/02/19
 * Time: 19:48
 */

namespace Factories;

use Models\FaqAnswerModel;

class FaqAnswerFactory
{

    public static function create($questionId, $answer)
    {
        $answerInstance = FaqAnswerModel::objects();
        $answerInstance->setCtFaqQuestionId($questionId);
        $answerInstance->setCtAnswer($answer);

        return $answerInstance;
    }
}