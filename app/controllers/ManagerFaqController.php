<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 11/02/19
 * Time: 20:12
 */

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\Routes;
use Kernel\mvcs\View;
use Models\ClientModel;
use Services\FaqService;

class ManagerFaqController extends Controller
{

    function get()
    {
        $clientId = $_GET["client"] ?? null;

        if ($clientId != null) {
            $clientFound = ClientModel::objects()->getByCtId($clientId);

            $questions = FaqService::getQuestionsByClient($clientFound);

            View::render('admin/register_faq', [
                'client' => $clientFound,
                'questions' => $questions,
            ]);
        } else {
            self::redirect(Routes::getPathByName('home'));
        }
    }

    function post()
    {
        $clientId = $_POST['client'] ?? null;
        $question = $_POST['question'] ?? null;

        $questionNew = FaqService::registerQuestion($clientId, $question);
        if (($questionNew != null)) {
            View::responseJson([
                'success' => true,
                'question' => [
                    'created' => $questionNew->wasCreated(),
                    'question' => $questionNew->getCtQuestion(),
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