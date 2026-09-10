<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Produto;
use PDO;

class ProdutoRepository
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * @return Produto[]
     */
    public function listar(): array
    {
        $stmt = $this->db->query("SELECT id, titulo, descricao, preco, desconto, preco_final, criado_em FROM produtos ORDER BY id ASC");
        $linhas = $stmt->fetchAll();

        return array_map(fn (array $dados) => new Produto(
            id: (int) $dados['id'],
            titulo: (string) $dados['titulo'],
            descricao: (string) $dados['descricao'],
            preco: (float) $dados['preco'],
            desconto: (float) $dados['desconto'],
            precoFinal: (float) $dados['preco_final'],
            criadoEm: isset($dados['criado_em']) ? (int) $dados['criado_em'] : null
        ), $linhas);
    }
}