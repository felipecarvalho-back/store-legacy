<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class CarrinhoDTO
{
    /**
     * @param CarrinhoItemDTO[] $itens
     */
    public function __construct(
        public array $itens,
        public float $subtotalOriginal,
        public int $descontoEspecialPercentual,
        public ?string $codigoPromocional,
        public int $descontoCupomPercentual,
        public float $total,
        public int $quantidadeItens
    ) {}
}
