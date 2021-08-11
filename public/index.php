<?php
/**
 * @User:   Eldeeno
 * Date:    10/08/2021
 * Time:    9:30 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;

$app = new Application();

$app->router->get('/', function () {
    return 'Hello World';
});
$app->router->get('/contact', 'contact');

$app->run();