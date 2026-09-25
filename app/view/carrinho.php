<?php
/** @var array[] $carrinho */
/** @var array[] $produtos */

require_once dirname(__DIR__) . '/config/funcoes.php';

if (!defined('LOJA')) {
    define('LOJA', 'Loja Legado');
}

$carrinho = $carrinho ?? [];
$produtos = $produtos ?? [];

// Gerenciamento seguro do cupom de desconto
$codigo_promocional = filter_input(INPUT_POST, 'codigo_promocional') ?? ($_POST['codigo_promocional'] ?? null);
if (!$codigo_promocional && !empty($_COOKIE['codigo_promocional'])) {
    $codigo_promocional = (string) $_COOKIE['codigo_promocional'];
}

if ($codigo_promocional) {
    setcookie('codigo_promocional', (string) $codigo_promocional, time() + 3600, '/');
}

// Cálculo do subtotal original
$subtotalOriginal = 0;
foreach ($carrinho as $item) {
    $subtotalOriginal += (float) ($item['preco_final'] ?? $item['preco'] ?? 0);
}

// Descontos e totais calculados pelas regras de negócio
$porcentagemPreco = precoComDesconto($carrinho, $codigo_promocional);
$porcentagem = $porcentagemPreco[0] ?? 0;
$total = $porcentagemPreco[1] ?? $subtotalOriginal;
$desconto_codigo_promocional = $porcentagemPreco[2] ?? 0;

$qtdItens = count($carrinho);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meu Carrinho - <?= htmlspecialchars((string) LOJA) ?></title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Estilo personalizado da loja -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <main class="container py-3">

        <!-- Inclusão do menu de navegação e cabeçalho -->
        <?php include __DIR__ . '/partials/menu.inc.php'; ?>

        <!-- Navegação Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-store mb-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none">
                        <i class="bi bi-house-door me-1"></i>Início
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Carrinho de Compras
                </li>
            </ol>
        </nav>

        <?php if ($qtdItens > 0): ?>
            <!-- Cabeçalho da Página do Carrinho -->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                <div>
                    <h1 class="cart-header-title mb-1">
                        <i class="bi bi-bag-check me-2 text-primary"></i>Meu Carrinho
                    </h1>
                    <p class="text-secondary small mb-0">
                        Você tem <strong><?= $qtdItens ?> <?= $qtdItens === 1 ? 'item' : 'itens' ?></strong> na sua sacola de compras
                    </p>
                </div>
                <a href="/" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i>Continuar Comprando
                </a>
            </div>

            <!-- Grid de 2 Colunas: Itens à esquerda, Resumo à direita -->
            <div class="row g-4 align-items-start mb-5">
                
                <!-- Coluna 1: Lista de Produtos -->
                <div class="col-lg-8">
                    <div class="cart-card-container">
                        <div class="p-3 bg-light bg-opacity-50 border-bottom border-subtle d-none d-md-flex align-items-center justify-content-between text-secondary small fw-bold text-uppercase">
                            <span>Produto</span>
                            <div class="d-flex align-items-center gap-5 pe-3">
                                <span>Preço Unitário</span>
                                <span>Total</span>
                                <span>Ação</span>
                            </div>
                        </div>

                        <?php foreach ($carrinho as $produto): 
                            $idProd = (int) ($produto['id'] ?? 0);
                            $tituloProd = (string) ($produto['titulo'] ?? 'Produto');
                            $precoBase = (float) ($produto['preco'] ?? 0);
                            $descontoProd = (int) ($produto['desconto'] ?? 0);
                            $precoFinal = (float) ($produto['preco_final'] ?? $precoBase);
                        ?>
                            <div class="cart-item-row d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                <!-- Imagem e Título -->
                                <div class="d-flex align-items-center gap-3">
                                    <a href="/produto/<?= $idProd ?>">
                                        <img src="/img/<?= $idProd ?>.jpg" 
                                             alt="<?= htmlspecialchars($tituloProd) ?>" 
                                             class="cart-item-thumb"
                                             onerror="this.src='/img/1.jpg';" />
                                    </a>
                                    <div>
                                        <a href="/produto/<?= $idProd ?>" class="cart-item-title d-block">
                                            <?= htmlspecialchars($tituloProd) ?>
                                        </a>
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <span class="badge bg-light text-secondary border small">
                                                Cód: #<?= str_pad((string)$idProd, 4, '0', STR_PAD_LEFT) ?>
                                            </span>
                                            <?php if ($descontoProd > 0): ?>
                                                <span class="badge bg-danger-subtle text-danger fw-bold small">
                                                    -<?= $descontoProd ?>% OFF
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preços e Ações -->
                                <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-4 mt-2 mt-md-0 pt-2 pt-md-0 border-top border-md-0">
                                    <div class="text-md-end">
                                        <?php if ($descontoProd > 0): ?>
                                            <div class="text-muted text-decoration-line-through small">
                                                R$ <?= number_format($precoBase, 2, ',', '.') ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="fw-bold fs-6 text-dark">
                                            R$ <?= number_format($precoFinal, 2, ',', '.') ?>
                                        </div>
                                    </div>

                                    <div>
                                        <a href="/remover.php?cod=<?= $idProd ?>" 
                                           class="cart-remove-btn" 
                                           title="Remover <?= htmlspecialchars($tituloProd) ?> da sacola"
                                           onclick="return confirm('Deseja realmente remover este produto?');">
                                            <i class="bi bi-trash3"></i>
                                            <span class="d-none d-sm-inline">Remover</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Faixa de Garantia e Confiança -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded-3 d-flex align-items-center gap-3 shadow-xs">
                                <i class="bi bi-truck fs-3 text-primary"></i>
                                <div>
                                    <div class="fw-bold small text-dark">Frete Rápido</div>
                                    <div class="text-muted small">Despacho em até 24h úteis</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded-3 d-flex align-items-center gap-3 shadow-xs">
                                <i class="bi bi-arrow-repeat fs-3 text-success"></i>
                                <div>
                                    <div class="fw-bold small text-dark">Troca Descomplicada</div>
                                    <div class="text-muted small">30 dias para devolução</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded-3 d-flex align-items-center gap-3 shadow-xs">
                                <i class="bi bi-shield-lock-fill fs-3 text-primary"></i>
                                <div>
                                    <div class="fw-bold small text-dark">Compra Protegida</div>
                                    <div class="text-muted small">Ambiente seguro com SSL</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna 2: Resumo do Pedido & Cupom -->
                <div class="col-lg-4">
                    <div class="cart-summary-sticky">
                        <h2 class="cart-summary-title">Resumo do Pedido</h2>

                        <!-- Formulário de Código Promocional -->
                        <div class="mb-4">
                            <label for="inputCupom" class="form-label small fw-bold text-secondary">
                                <i class="bi bi-ticket-perforated me-1 text-primary"></i>Possui Cupom de Desconto?
                            </label>
                            <form action="" method="post" class="d-flex gap-2">
                                <input type="text" 
                                       id="inputCupom" 
                                       name="codigo_promocional" 
                                       value="<?= htmlspecialchars((string) ($codigo_promocional ?? '')) ?>" 
                                       placeholder="Digite seu cupom" 
                                       class="form-control rounded-pill px-3 text-uppercase" 
                                       required />
                                <button type="submit" class="btn btn-dark rounded-pill px-3 fw-semibold">
                                    Aplicar
                                </button>
                            </form>

                            <?php if (!empty($codigo_promocional)): ?>
                                <?php if ($desconto_codigo_promocional > 0): ?>
                                    <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mt-2 rounded-3 small border-0 shadow-xs mb-0">
                                        <i class="bi bi-check-circle-fill text-success fs-6"></i>
                                        <div>
                                            Cupom <strong><?= htmlspecialchars(strtoupper((string) $codigo_promocional)) ?></strong> ativo:
                                            <span class="fw-bold"><?= (int) $desconto_codigo_promocional ?>% OFF</span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-2 px-3 mt-2 rounded-3 small border-0 shadow-xs mb-0">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                        Cupom não encontrado ou já expirado.
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Detalhamento de Valores -->
                        <div class="cart-price-row">
                            <span>Subtotal (<?= $qtdItens ?> <?= $qtdItens === 1 ? 'item' : 'itens' ?>)</span>
                            <span class="fw-semibold text-dark">R$ <?= number_format($subtotalOriginal, 2, ',', '.') ?></span>
                        </div>

                        <?php if ($porcentagem > 0): ?>
                            <div class="cart-price-row text-success">
                                <span><i class="bi bi-gift-fill me-1"></i>Desconto Especial</span>
                                <span class="fw-bold">-<?= $porcentagem ?>%</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($desconto_codigo_promocional > 0): ?>
                            <div class="cart-price-row text-success">
                                <span><i class="bi bi-tag-fill me-1"></i>Cupom Promocional</span>
                                <span class="fw-bold">-<?= (int) $desconto_codigo_promocional ?>%</span>
                            </div>
                        <?php endif; ?>

                        <div class="cart-price-row">
                            <span>Frete</span>
                            <span class="badge bg-success-subtle text-success fw-bold px-2 py-1">GRÁTIS</span>
                        </div>

                        <!-- Total Final -->
                        <div class="cart-price-total">
                            <div>
                                <span class="d-block fw-bold text-secondary small text-uppercase">Total a Pagar</span>
                                <span class="text-muted small">À vista ou parcelado</span>
                            </div>
                            <span class="cart-total-value">
                                R$ <?= number_format((float) $total, 2, ',', '.') ?>
                            </span>
                        </div>

                        <!-- Parcelamento -->
                        <p class="text-muted small text-end mt-1 mb-4">
                            Em até <strong>10x de R$ <?= number_format((float) ($total / 10), 2, ',', '.') ?></strong> sem juros
                        </p>

                        <!-- Botão de Finalização Principal -->
                        <a href="/finalizar.php" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                            <i class="bi bi-shield-check fs-5"></i>
                            <span>Continuar para Checkout</span>
                        </a>

                        <div class="text-center">
                            <span class="text-muted small d-inline-flex align-items-center gap-1">
                                <i class="bi bi-lock-fill text-success"></i> Transação 100% Criptografada
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        <?php else: ?>
            <!-- Estado Vazio (Empty State) -->
            <div class="cart-empty-box my-4">
                <div class="cart-empty-icon-wrap">
                    <i class="bi bi-bag-x"></i>
                </div>
                <h2 class="fw-bold mb-2">Sua sacola de compras está vazia</h2>
                <p class="text-muted mx-auto mb-4" style="max-width: 460px;">
                    Você ainda não adicionou nenhum item ao seu carrinho. Explore nosso catálogo exclusivo e encontre produtos imperdíveis para você!
                </p>
                <a href="/" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Explorar Produtos da Loja</span>
                </a>
            </div>
        <?php endif; ?>

    </main>

    <!-- Inclusão do Rodapé Moderno -->
    <?php include __DIR__ . '/partials/rodape.inc.php'; ?>

    <!-- Bootstrap 5.3 Bundle com Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>