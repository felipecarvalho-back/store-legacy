<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ProdutoCategoriaDTO
{
    public function __construct(
        public int $id,
        public int $categoria_id,
        public string $categoria,
        public string $titulo,
        public string $descricao,
        public float $preco,
        public int $desconto,
        public float $precoFinal
    ) {}
}
