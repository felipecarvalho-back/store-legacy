<?php

use App\Controller\CarrinhoController;
use App\Controller\HomeController;
use App\Controller\ProdutoController;
use Slim\App;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/produto/{id}', [ProdutoController::class, 'index']);
    $app->get('/categoria/{id}', [ProdutoController::class, 'categoria']);
    $app->get('/adicionar/{id}', [CarrinhoController::class, 'adicionar']);
    $app->map(['GET', 'POST'], '/carrinho', [CarrinhoController::class, 'carrinho']);
    $app->map(['GET', 'POST'], '/carrinho.php', [CarrinhoController::class, 'carrinho']);
    $app->get('/remover/{id}', [CarrinhoController::class, 'remover']);
    $app->get('/remover.php', [CarrinhoController::class, 'remover']);
};