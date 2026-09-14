<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Categoria;
use App\DTO\ProdutoHomeDTO;
use \PDO;

class CategoriaRepository
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * @return Categoria[]
     */
    public function getCategoria()
    {
        $categorias = $this->db->query("SELECT categorias.id, categorias.titulo FROM categorias ORDER BY titulo")->fetchAll();

        return array_map(fn(array $dados) => new Categoria(
            id: (int) $dados['id'],
            titulo: (string) $dados['titulo'],
        ), $categorias);
    }

    public function getAllCategoria(int $idCat)
    {
        $stmt = $this->db->prepare("SELECT DISTINCT
		    produtos.id, categorias.titulo as categoria, produtos.titulo, produtos.preco, 
		    produtos.desconto, produtos.preco_final
		    FROM produtos
		    LEFT JOIN categorias_produtos ON produtos.id = categorias_produtos.id_produto
		    LEFT JOIN categorias ON categorias_produtos.id_categoria = categorias.id
		    WHERE categorias.id = :id");
        $stmt->execute(['id' => $idCat]);
        $linhas = $stmt->fetchAll();

        return array_map(fn(array $dados) => new ProdutoHomeDTO(
            id: (int) $dados['id'],
            titulo: (string) $dados['titulo'],
            categoria: (string) ($dados['categoria'] ?? ''),
            preco: (float) $dados['preco'],
            desconto: (int) $dados['desconto'],
            precoFinal: (float) $dados['preco_final']
        ), $linhas);
    }
}
