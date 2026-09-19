<?php

use App\Controller\HomeController;
use App\Controller\ProdutoController;
use Slim\App;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/produto/{id}', [ProdutoController::class, 'index']);
    $app->get('/categoria/{id}', [ProdutoController::class, 'categoria']);
    $app->get('/adicionar/{id}', [ProdutoController::class, 'adicionar']);
};