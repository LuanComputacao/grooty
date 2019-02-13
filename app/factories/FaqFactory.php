<?php

namespace Factories;

use Models\FaqModel;

class FaqFactory
{
    public static function create(
        $clientId,
        $question
    ) {
        $questionInstance = FaqModel::objects();
        $questionInstance->setCtClient($clientId);
        $questionInstance->setCtQuestion($question);

        return $questionInstance;
    }
}