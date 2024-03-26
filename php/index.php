<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get('/alunni', "AlunniController:index");

$app->get('/alunni/{id}', "AlunniController:show");

$app->post('/alunni', "AlunniController:alunniPOST");

$app->put('/alunni/{id}', "AlunniController:alunniPUT");

$app->delete('/alunni/{id}', "AlunniController:alunniDELETE");

$app->run();
