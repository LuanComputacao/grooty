<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 16/12/18
 * Time: 13:28
 */

namespace Services;

use Factories\FaqAnswerFactory;
use Factories\FaqFactory;
use Models\ClientModel;
use Models\FaqModel;

class FaqService
{
    public static function getClientFaq(ClientModel $clientModel): array
    {
        $faq = [];
        $faqRows = FaqModel::objects()->getQuestionsAndAnswersByClient($clientModel);

        foreach ($faqRows as $row) {
            if (!isset($faq[$row['id']])) {
                $faq[$row['id']] = [
                    'question' => html_entity_decode($row['question']),
                    'answers' => [],
                ];
            }
            array_push($faq[$row['id']]['answers'], html_entity_decode($row['answer']));
        }

        return $faq;
    }

    public static function registerQuestion($client, $question)
    {
        $questionNew = null;

        if ($client != '' && $question != null) {
            $questionNew = FaqFactory::create($client, $question);
            $questionNew->save();
        }

        return $questionNew;
    }

    public static function getQuestionsByClient($client)
    {
        $questions = FaqModel::objects()->getQuestionsByClient($client);

        return $questions;
    }

    public static function registerAnswer($clientId, $questionId, $answer)
    {
        $answerNew = null;

        if (
            $clientId != null &&
            $questionId != null &&
            $answer != null &&
            $answer != ''
        ) {
            $answerNew = FaqAnswerFactory::create($questionId, $answer);
            $answerNew->save();
        }

        return $answerNew;
    }

}