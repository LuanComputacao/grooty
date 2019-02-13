<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 07/02/19
 * Time: 04:16
 */

namespace Controllers;

use Kernel\mvcs\Controller;
use Kernel\mvcs\View;
use Models\ClientModel;
use Services\FaqService;

class FaqQuestionController extends Controller
{
    function post()
    {
        $origin = $_SERVER["HTTP_ORIGIN"] ?? '';
        $token = $_POST['token'] ?? '';
        $client = ClientModel::objects()->getByCtSiteUrlAndCtTokenApi($origin, $token);

        $faq = [];
        $view = '';
        if ($client->getCtId() > 0) {
            self::allowCORSOrigin($client->getCtSiteUrl());
            $faq = FaqService::getClientFaq($client);
            $view = View::mount('partials/_faq', ['questions' => $faq]);
        }

        View::responseJson([
            'success' => ($faq != []),
            'faq' => $view,
        ]);
    }
}