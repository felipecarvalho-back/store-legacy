<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProdutoRepository;

class HomeController extends Controller
{
    public function __construct(
        private ProdutoRepository $produtoRepository
    ) {}

    public function index()
    {
        $produtos = $this->produtoRepository->getConfiProdutos();
        return $this->view('index', ['titulo' => 'Loja', 'produtos' => $produtos]);
    }
}
