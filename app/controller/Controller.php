<?php

declare(strict_types=1);

namespace App\Controller;


use Slim\Psr7\Response;

abstract class Controller
{
    protected function view(string $view, array $dados = []): Response
    {
        $response = new Response();
        $arquivo = dirname(__DIR__) . "/view/{$view}.php";

        if (!file_exists($arquivo)) {
            $response->getBody()->write("View '{$view}' não encontrada.");
            return $response->withStatus(404);
        }

        extract($dados);

        ob_start();
        require $arquivo;
        $conteudo = (string) ob_get_clean();

        $response->getBody()->write($conteudo);

        return $response;
    }
}
