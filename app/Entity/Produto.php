<?php

declare(strict_types=1);

namespace App\Entity;

final readonly class Produto
{
    public function __construct(
        public ?int $id,
        public string $titulo,
        public string $descricao,
        public float $preco,
        public float $desconto,
        public float $precoFinal,
        public ?int $criadoEm = null
    ) {}
}
