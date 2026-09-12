<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoriaRepository;
use App\Repository\ProdutoRepository;

class HomeController extends Controller
{
    public function __construct(
        private ProdutoRepository $produtoRepository,
        private CategoriaRepository $categoriaRepository
    ) {}

    public function index()
    {
        $produtos = $this->produtoRepository->getConfiProdutos();
        $categorias = $this->categoriaRepository->getCategoria();
        return $this->view('index', ['titulo' => 'Loja', 'produtos' => $produtos, 'categorias' => $categorias]);
    }
}
