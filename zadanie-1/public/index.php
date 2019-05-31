<?php

require '../vendor/autoload.php';

use App\Factory\ControllerFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

$request = Request::createFromGlobals();
$controller = ControllerFactory::create(require '../config.php');

try {
    if ($request->query->has('upload')) {
        $response = $controller->upload(
            $request,
            $session
        );
    } else {
        $response = $controller->files($session);
    }
    $response->send();
} catch(\Exception $e) {
    /** ... */
}
