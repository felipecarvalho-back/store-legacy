<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\ProdutoHomeDTO;
use App\Entity\Produto;
use PDO;

class ProdutoRepository
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * @return ProdutoHomeDTO[]
     */
    public function getConfiProdutos(): array
    {
        $config = $this->db->query("SELECT valor FROM configuracoes WHERE chave = 'produtos_home'")->fetch();

        if (empty($config['valor'])) {
            return [];
        }

        $ids = array_filter(array_map('intval', explode(',', $config['valor'])));

        if (empty($ids)) {
            return [];
        }

        $produtos_ids = implode(', ', $ids);

        $orderBy = "FIELD(produtos.id, {$produtos_ids})";

        $sql = "SELECT                                                                                                                
                produtos.id,                                                                                                      
                COALESCE(GROUP_CONCAT(categorias.titulo SEPARATOR ', '), '') AS categoria,                                                      
                produtos.titulo,                                                                                                  
                produtos.preco,                                                                                                   
                produtos.desconto,                                                                                                
                produtos.preco_final                                                                                              
            FROM produtos                                                                                                         
            LEFT JOIN categorias_produtos ON produtos.id = categorias_produtos.id_produto                                         
            LEFT JOIN categorias ON categorias_produtos.id_categoria = categorias.id                                              
            WHERE produtos.id IN ({$produtos_ids})
            GROUP BY produtos.id
            ORDER BY {$orderBy}
            LIMIT 9";

        $linhas = $this->db->query($sql)->fetchAll();

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
