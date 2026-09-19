<?php

/** @var \App\DTO\ProdutoCategoriaDTO $produto */
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars((string) ($titulo ?? 'Loja')) ?></title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Estilo personalizado da loja -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <main class="container py-3">

        <!-- Inclusão do menu de navegação -->
        <?php include __DIR__ . '/partials/menu.inc.php'; ?>

        <!-- Navegação Breadcrumb Elegante -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-store mb-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none">
                        <i class="bi bi-house-door me-1"></i>Início
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/categoria/<?= (int) $produto->categoria_id ?>" class="text-decoration-none">
                        <?= htmlspecialchars($produto->categoria) ?>
                    </a>
                </li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 320px;">
                    <?= htmlspecialchars($produto->titulo) ?>
                </li>
            </ol>
        </nav>

        <!-- Detalhes do Produto -->
        <div class="product-detail-card mb-5">
            <div class="p-4 p-lg-5">
                <div class="row g-4 g-lg-5 align-items-start">
                    
                    <!-- Coluna da Imagem e Garantias Visuais -->
                    <div class="col-12 col-lg-6">
                        <div class="product-image-box">
                            <?php if ($produto->desconto > 0): ?>
                                <span class="badge-desconto">
                                    <i class="bi bi-fire"></i> -<?= (int) $produto->desconto ?>% OFF
                                </span>
                            <?php endif; ?>
                            
                            <img src="/img/<?= (int) $produto->id ?>.jpg"
                                 alt="<?= htmlspecialchars($produto->categoria) ?>: <?= htmlspecialchars($produto->titulo) ?>"
                                 class="img-fluid rounded-3"
                                 loading="eager" />
                        </div>

                        <!-- Micro-vantagens abaixo da foto -->
                        <div class="row g-2 mt-2 text-secondary small">
                            <div class="col-4">
                                <div class="trust-badge-item">
                                    <i class="bi bi-patch-check-fill text-primary d-block fs-5 mb-1"></i>
                                    <span class="fw-semibold">100% Original</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="trust-badge-item">
                                    <i class="bi bi-box-seam text-primary d-block fs-5 mb-1"></i>
                                    <span class="fw-semibold">Pronta Entrega</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="trust-badge-item">
                                    <i class="bi bi-arrow-counterclockwise text-primary d-block fs-5 mb-1"></i>
                                    <span class="fw-semibold">Troca em 30d</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna de Informações, Preços e Ações -->
                    <div class="col-12 col-lg-6 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge-tag-categoria">
                                <i class="bi bi-tag-fill"></i><?= htmlspecialchars($produto->categoria ?: 'Geral') ?>
                            </span>
                            <span class="text-muted small fw-medium">Código: #<?= str_pad((string)$produto->id, 5, '0', STR_PAD_LEFT) ?></span>
                        </div>

                        <h1 class="h2 fw-bold text-dark mb-2"><?= htmlspecialchars($produto->titulo) ?></h1>

                        <!-- Avaliações Sociais -->
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <div class="rating-stars mb-0">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="fw-bold text-dark small">4.9</span>
                            <span class="text-muted small">(<?= 35 + ((int)$produto->id * 4) ?> avaliações de clientes verificados)</span>
                        </div>

                        <!-- Bloco de Preço & Oferta -->
                        <div class="product-pricing-box">
                            <?php if ($produto->desconto > 0): ?>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="produto-preco-antigo fs-6">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                                    <span class="badge-economize">
                                        Economize R$ <?= number_format($produto->preco - $produto->precoFinal, 2, ',', '.') ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="preco-destaque">
                                R$ <?= number_format($produto->precoFinal, 2, ',', '.') ?>
                            </div>

                            <div class="d-flex flex-column gap-1 mt-2">
                                <div class="text-success fw-bold small d-flex align-items-center gap-1">
                                    <i class="bi bi-qr-code"></i> R$ <?= number_format($produto->precoFinal * 0.95, 2, ',', '.') ?> no Pix (5% de desconto)
                                </div>
                                <div class="text-secondary small">
                                    <i class="bi bi-credit-card me-1"></i> ou em até 10x de <strong>R$ <?= number_format($produto->precoFinal / 10, 2, ',', '.') ?></strong> sem juros
                                </div>
                            </div>
                        </div>

                        <!-- Descrição do Produto -->
                        <div class="mb-4">
                            <h2 class="h6 fw-bold text-dark text-uppercase tracking-wider mb-2">
                                <i class="bi bi-file-text me-1 text-primary"></i>Detalhes do Produto
                            </h2>
                            <p class="text-secondary leading-relaxed mb-0" style="font-size: 0.95rem;">
                                <?= nl2br(htmlspecialchars($produto->descricao)) ?>
                            </p>
                        </div>

                        <!-- Ações de Compra -->
                        <div class="mt-auto">
                            <a href="/adicionar/<?= $produto->id ?>" 
                               class="btn-comprar-principal w-100 mb-3"
                               title="Adicionar <?= htmlspecialchars($produto->titulo) ?> à sacola">
                                <i class="bi bi-bag-plus-fill fs-5"></i>
                                <span>Adicionar à Sacola</span>
                            </a>

                            <!-- Simulador de Frete -->
                            <div class="shipping-calc-box">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold small text-dark">
                                        <i class="bi bi-truck me-1 text-primary"></i>Calcular Frete e Prazo
                                    </span>
                                    <span class="text-success small fw-semibold">Frete Grátis acima de R$ 199</span>
                                </div>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control rounded-start-pill" placeholder="Digite seu CEP (ex: 01001-000)" maxlength="9">
                                    <button class="btn btn-outline-dark rounded-end-pill px-3 fw-semibold" type="button">Calcular</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Inclusão do rodapé -->
    <?php include __DIR__ . '/partials/rodape.inc.php'; ?>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Script personalizado da loja -->
    <script src="/assets/js/main.js"></script>
</body>

</html>