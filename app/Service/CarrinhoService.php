<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CarrinhoDTO;
use App\Repository\ProdutoRepository;

class CarrinhoService
{
    public function __construct(
        private ProdutoRepository $produtoRepository
    ) {}

    /**
     * @param int[]|string[] $idsProdutos
     */
    public function calcularCarrinho(array $idsProdutos, ?string $codigoPromocional = null): CarrinhoDTO
    {
        $itens = $this->produtoRepository->getItensCarrinho($idsProdutos);
        $qtd = count($itens);

        $subtotal = 0.0;
        foreach ($itens as $item) {
            $subtotal += $item->precoFinal;
        }

        // Regra de desconto por volume de itens
        $descontoEspecial = match (true) {
            $qtd > 4 => 14,
            $qtd === 4 => 12,
            $qtd === 3 => 7,
            $qtd === 2 => 5,
            default => 0,
        };

        $totalComDesconto = $subtotal - ($subtotal * $descontoEspecial / 100);

        // Regra de cupom de desconto promocional
        $descontoCupom = 0;
        if (!empty($codigoPromocional)) {
            $descontoCupom = $this->produtoRepository->buscarDescontoCupom($codigoPromocional);
            if ($descontoCupom > 0) {
                $totalComDesconto = $totalComDesconto - ($totalComDesconto * $descontoCupom / 100);
            }
        }

        return new CarrinhoDTO(
            itens: $itens,
            subtotalOriginal: round($subtotal, 2),
            descontoEspecialPercentual: $descontoEspecial,
            codigoPromocional: $codigoPromocional,
            descontoCupomPercentual: $descontoCupom,
            total: round($totalComDesconto, 2),
            quantidadeItens: $qtd
        );
    }
}
