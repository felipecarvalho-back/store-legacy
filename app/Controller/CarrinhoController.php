<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProdutoRepository;

class CarrinhoController extends Controller
{
    public function __construct(
        private ProdutoRepository $produtoRepository,
    ) {}
    public function adicionar($request, $response, array $args)
    {
        $id = (int) $args['id'];

        $carrinhoAtual = $_COOKIE['carrinho'] ?? '';
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

        $carrinhoAtual = $_COOKIE['carrinho'] ?? '';
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
        if (!isset($_COOKIE) || !isset($_COOKIE['carrinho'])) {
            $_COOKIE['carrinho'] = '';
        }

        $carrinho_cookies = array_filter(explode(',', (string) $_COOKIE['carrinho']));

        [$carrinho, $produtos] = $this->produtoRepository->carrinho($carrinho_cookies);

        return $this->view("carrinho", ["carrinho" => $carrinho, "produtos" => $produtos]);
    }
}
