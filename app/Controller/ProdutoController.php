<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProdutoRepository;
use App\Repository\CategoriaRepository;

class ProdutoController extends Controller
{
    public function __construct(
        private ProdutoRepository $produtoRepository,
        private CategoriaRepository $categoriaRepository
    ) {}
    public function index($request, $response, array $args)
    {
        $id = (int) $args['id'];
        $produto = $this->produtoRepository->getDescricaoProduto($id);

        $categorias = $this->categoriaRepository->getCategoria();
        $categoria_id = $produto->categoria_id;

        return $this->view('produtos', [
            'titulo' => $produto->titulo,
            'produto' => $produto,
            'categoria_id' => $categoria_id,
            'categorias' => $categorias
        ]);
    }

    public function categoria($request, $response, array $args)
    {
        $id = (int) $args['id'];

        $produtos = $this->categoriaRepository->getAllCategoria($id);

        $categorias = $this->categoriaRepository->getCategoria();

        return $this->view('categorias', [
            'produtos' => $produtos,
            'categorias' => $categorias,
            'categoria_id' => $id
        ]);
    }

    
}
