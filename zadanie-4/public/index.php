<?php

require '../vendor/autoload.php';

use App\Service\FormValidator;
use App\Factory\SmartyFactory;
use App\Controller\FormController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

$request = Request::createFromGlobals();

try {
    $controller = new FormController(
        SmartyFactory::create(),
        new FormValidator()
    );
    if ($request->query->has('form')) {
        $response = $controller->form($request, $session);
    } else {
        $response = $controller->index();
    }
    $response->send();
} catch(\Exception $e) {
    /** ... */
    echo $e->getMessage();
}
