<?php

require '../vendor/autoload.php';

use App\Factory\ControllerFactory;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$controller = ControllerFactory::create(require '../config.php');

try {
    if ($request->query->has('upload')) {
        $response = $controller->upload($request);
    } else {
        $response = $controller->files();
    }
    $response->send();
} catch(\Exception $e) {
    /** ... */
}
