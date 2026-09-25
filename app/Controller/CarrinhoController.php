<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoriaRepository;
use App\Service\CarrinhoService;

class CarrinhoController extends Controller
{
    public function __construct(
        private CarrinhoService $carrinhoService,
        private CategoriaRepository $categoriaRepository
    ) {}

    public function adicionar($request, $response, array $args)
    {
        $id = (int) $args['id'];

        $carrinhoAtual = (string) ($_COOKIE['carrinho'] ?? '');
        $produtos = trim($carrinhoAtual . ',' . $id, ',');
        $produtosArr = array_filter(explode(',', $produtos));
        $produtosArr = array_unique($produtosArr);
        $produtosStr = implode(',', $produtosArr);

        setcookie('carrinho', $produtosStr, time() + 3600, '/');

        return $response
            ->withHeader('Location', '/carrinho')
            ->withStatus(302);
    }

    public function remover($request, $response, array $args)
    {
        $id = (int) ($args['id'] ?? ($_GET['cod'] ?? 0));

        $carrinhoAtual = (string) ($_COOKIE['carrinho'] ?? '');
        $produtosArr = array_filter(explode(',', $carrinhoAtual));
        $produtosArr = array_filter($produtosArr, fn($item) => (int) $item !== $id);
        $produtosStr = implode(',', $produtosArr);

        setcookie('carrinho', $produtosStr, time() + 3600, '/');

        return $response
            ->withHeader('Location', '/carrinho')
            ->withStatus(302);
    }

    public function carrinho($request, $response)
    {
        $carrinhoAtual = (string) ($_COOKIE['carrinho'] ?? '');
        $ids = array_filter(explode(',', $carrinhoAtual));

        // Captura cupom via POST ou lê de COOKIE prévio
        $codigoPromocional = null;
        if ($request->getMethod() === 'POST') {
            $parsedBody = (array) ($request->getParsedBody() ?? []);
            $codigoPost = trim((string) ($parsedBody['codigo_promocional'] ?? ''));
            if ($codigoPost !== '') {
                $codigoPromocional = $codigoPost;
                setcookie('codigo_promocional', $codigoPromocional, time() + 3600, '/');
            }
        } elseif (!empty($_COOKIE['codigo_promocional'])) {
            $codigoPromocional = trim((string) $_COOKIE['codigo_promocional']);
        }

        $carrinho = $this->carrinhoService->calcularCarrinho($ids, $codigoPromocional);
        $categorias = $this->categoriaRepository->getCategoria();

        return $this->view('carrinho', [
            'carrinho' => $carrinho,
            'categorias' => $categorias,
        ]);
    }
}
