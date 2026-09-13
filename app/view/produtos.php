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

    <main class="container py-4">

        <!-- Inclusão do menu de navegação -->
        <?php include __DIR__ . '/partials/menu.inc.php'; ?>

        <!-- Navegação Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb py-2 px-3 bg-white rounded-pill border shadow-sm align-items-center mb-0">
                <li class="breadcrumb-item">
                    <a href="/" class="text-secondary text-decoration-none fw-semibold">
                        <i class="bi bi-house-door-fill me-1"></i>Início
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/categorias.php?cod=<?= (int) $produto->categoria_id ?>" class="text-secondary text-decoration-none fw-semibold">
                        <?= htmlspecialchars($produto->categoria) ?>
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">
                    <?= htmlspecialchars($produto->titulo) ?>
                </li>
            </ol>
        </nav>

        <!-- Detalhes do Produto -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-4 g-lg-5 align-items-start">
                    <!-- Coluna da Imagem -->
                    <div class="col-12 col-lg-6">
                        <div class="position-relative rounded-4 overflow-hidden bg-light border text-center p-3 d-flex align-items-center justify-content-center" style="min-height: 380px;">
                            <?php if ($produto->desconto > 0): ?>
                                <span class="badge-desconto position-absolute top-0 end-0 m-3">
                                    <i class="bi bi-arrow-down-short"></i>-<?= (int) $produto->desconto ?>%
                                </span>
                            <?php endif; ?>
                            <img src="/img/<?= (int) $produto->id ?>.jpg"
                                 alt="<?= htmlspecialchars($produto->categoria) ?>: <?= htmlspecialchars($produto->titulo) ?>"
                                 class="img-fluid rounded-3 object-fit-contain"
                                 style="max-height: 450px;" />
                        </div>
                    </div>

                    <!-- Coluna de Informações e Compra -->
                    <div class="col-12 col-lg-6 d-flex flex-column">
                        <div class="mb-2">
                            <span class="produto-categoria-tag">
                                <i class="bi bi-tag-fill me-1"></i><?= htmlspecialchars($produto->categoria ?: 'Geral') ?>
                            </span>
                        </div>

                        <h1 class="h2 fw-bold text-dark mb-3"><?= htmlspecialchars($produto->titulo) ?></h1>

                        <!-- Bloco de Preços -->
                        <div class="p-3 bg-light rounded-3 mb-4 border">
                            <?php if ($produto->desconto > 0): ?>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="produto-preco-antigo fs-6">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                                    <span class="badge bg-danger-subtle text-danger fw-bold rounded-pill px-2 py-1 small">
                                        <?= (int) $produto->desconto ?>% OFF
                                    </span>
                                </div>
                            <?php endif; ?>
                            <div class="produto-preco-atual fs-2">
                                R$ <?= number_format($produto->precoFinal, 2, ',', '.') ?>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="bi bi-credit-card me-1"></i> Em até 10x sem juros no cartão
                            </small>
                        </div>

                        <!-- Descrição do Produto -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-2">Descrição do Produto</h5>
                            <p class="text-secondary leading-relaxed mb-0">
                                <?= nl2br(htmlspecialchars($produto->descricao)) ?>
                            </p>
                        </div>

                        <!-- Ações de Compra -->
                        <div class="mt-auto pt-3">
                            <a href="/adicionar.php?cod=<?= (int) $produto->id ?>" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="bi bi-cart-plus-fill fs-5"></i>
                                <span>Adicionar ao carrinho</span>
                            </a>

                            <!-- Selos de Confiança -->
                            <div class="row g-2 text-center text-secondary small pt-3 border-top">
                                <div class="col-4">
                                    <i class="bi bi-truck fs-5 d-block text-primary mb-1"></i>
                                    <span>Entrega Rápida</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-shield-check fs-5 d-block text-primary mb-1"></i>
                                    <span>Compra Segura</span>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-arrow-repeat fs-5 d-block text-primary mb-1"></i>
                                    <span>Troca Fácil</span>
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