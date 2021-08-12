<?php
/**
 * @User:   Eldeeno
 * Date:    10/08/2021
 * Time:    9:30 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');

$app->run();