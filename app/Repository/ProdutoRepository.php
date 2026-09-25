<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\CarrinhoItemDTO;
use App\DTO\ProdutoCategoriaDTO;
use App\DTO\ProdutoHomeDTO;
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

    public function getDescricaoProduto(int $prodId): ?ProdutoCategoriaDTO
    {
        $stmt = $this->db->prepare(
            "SELECT produtos.id as id, categorias.id as categoria_id, categorias.titulo as categoria, produtos.titulo,        
                        produtos.descricao, produtos.preco, produtos.desconto, produtos.preco_final                                                     
                FROM produtos                                                                                                     
                JOIN categorias_produtos ON categorias_produtos.id_produto = produtos.id                                          
                JOIN categorias ON categorias_produtos.id_categoria = categorias.id                                               
                WHERE produtos.id = :id"
        );
        $stmt->execute(['id' => $prodId]);
        $dados = $stmt->fetch();

        if (!$dados) {
            return null;
        }

        return new ProdutoCategoriaDTO(
            id: (int) $dados['id'],
            categoria_id: (int) $dados['categoria_id'],
            categoria: (string) $dados['categoria'],
            titulo: (string) $dados['titulo'],
            descricao: (string) $dados['descricao'],
            preco: (float) $dados['preco'],
            desconto: (int) $dados['desconto'],
            precoFinal: (float) $dados['preco_final']
        );
    }

    public function getIdProduto(int $prodId): int
    {
        $stmt = $this->db->prepare("SELECT produtos.id FROM produtos WHERE produtos.id = :id")->fetch();
        $stmt->execute(['id' => $prodId]);
        $id = $stmt->fetch();

        return $id;
    }

    /**
     * @param int[]|string[] $carrinho_cookies
     * @return CarrinhoItemDTO[]
     */
    public function getItensCarrinho(array $carrinho_cookies): array
    {
        $ids = array_filter(array_map('intval', $carrinho_cookies));
        if (empty($ids)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT id, titulo, preco, desconto, preco_final FROM produtos WHERE id IN ({$placeholders})");
        $stmt->execute(array_values($ids));
        $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $produtosMap = [];
        foreach ($linhas as $linha) {
            $produtosMap[(int) $linha['id']] = new CarrinhoItemDTO(
                id: (int) $linha['id'],
                titulo: (string) $linha['titulo'],
                preco: (float) $linha['preco'],
                desconto: (int) $linha['desconto'],
                precoFinal: (float) $linha['preco_final']
            );
        }

        $resultado = [];
        foreach ($ids as $id) {
            if (isset($produtosMap[$id])) {
                $resultado[] = $produtosMap[$id];
            }
        }

        return $resultado;
    }

    public function buscarDescontoCupom(string $codigo): int
    {
        $stmt = $this->db->prepare("SELECT desconto FROM codigos_promocionais WHERE codigo = :codigo AND usado = 0");
        $stmt->execute(['codigo' => trim($codigo)]);
        $desconto = $stmt->fetchColumn();

        return $desconto !== false ? (int) $desconto : 0;
    }
}
