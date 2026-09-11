<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class ProdutoHomeDTO
{
    public function __construct(
        public int $id,
        public string $titulo,
        public string $categoria,
        public float $preco,
        public int $desconto,
        public float $precoFinal
    ) {}
}
