<?php

use Controllers\{FaqQuestionController,
    HomeController,
    ManagerFaqAnswersController,
    ManagerFaqController,
    ManagerRegisterController,
    SupportController};
use Kernel\mvcs\Routes;

$urlsMap = [
    "home" => ["/", HomeController::class],
    "support" => ["/support", SupportController::class],
    "faq-question" => ["/faq-question", FaqQuestionController::class],
];

$manager = [
    "manager-register-client" => ["/manager/register-client", ManagerRegisterController::class],
    "manager-faq" => ["/manager/register-faq", ManagerFaqController::class],
    "manager-faq-answers" => ["/manager/register-answer", ManagerFaqAnswersController::class],
];

$urlsMap = array_merge($urlsMap, $manager);

new Routes($urlsMap);