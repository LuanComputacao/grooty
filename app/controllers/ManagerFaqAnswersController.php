<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 12/02/19
 * Time: 19:07
 */

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\View;
use Models\ClientModel;
use Models\FaqAnswerModel;
use Models\FaqModel;
use Services\FaqService;

class ManagerFaqAnswersController extends Controller
{
    public function get()
    {
        $clientId = $_GET["client"] ?? null;
        $faqId = $_GET["question"] ?? null;

        if ($clientId != null) {
            $clientFound = ClientModel::objects()->getByCtId($clientId);
            $faqFound = FaqModel::objects()->getQuestionById($faqId);
            $answers = FaqAnswerModel::objects()->getByQuestionsId($faqFound->getCtId());

            $args = [
                "client" => $clientFound,
                "faq" => $faqFound,
                "answers" => $answers,
            ];

            View::render('admin/register_answer', $args);
        }
    }

    public function post()
    {
        $clientId = $_POST['client'] ?? null;
        $question = $_POST['question'] ?? null;
        $answer = $_POST['answer'] ?? null;

        $questionNew = FaqService::registerAnswer($clientId, $question, $answer);
        if (($questionNew != null)) {
            View::responseJson([
                'success' => true,
                'answer' => [
                    'created' => $questionNew->wasCreated(),
                    'question' => $questionNew->getCtFaqQuestionId(),
                    'answer' => $questionNew->getCtAnswer(),
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