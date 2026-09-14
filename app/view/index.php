<?php

/** @var \App\DTO\ProdutoHomeDTO[] $produtos */
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

        <!-- Inclusão do menu de navegação e header -->
        <?php include __DIR__ . '/partials/menu.inc.php'; ?>

        <!-- Hero Showcase Banner -->
        <section class="hero-banner mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="hero-badge mb-3">
                        <i class="bi bi-stars"></i> Coleção <?= date('Y') ?> em Destaque
                    </span>
                    <h1 class="hero-title mb-3">
                        Estilo exclusivo com qualidade superior para você
                    </h1>
                    <p class="hero-description mb-4">
                        Descubra nossa curadoria de peças selecionadas com tecidos premium, caimento impecável e descontos imperdíveis de até 30% OFF.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="hero-feature-item">
                            <i class="bi bi-lightning-charge-fill"></i> Envio em 24h
                        </span>
                        <span class="hero-feature-item">
                            <i class="bi bi-shield-check"></i> Garantia de 30 Dias
                        </span>
                        <span class="hero-feature-item">
                            <i class="bi bi-credit-card"></i> Até 10x Sem Juros
                        </span>
                    </div>
                    <div>
                        <a href="#vitrine-produtos" class="btn btn-light rounded-pill px-4 py-3 fw-bold text-dark shadow-sm">
                            <i class="bi bi-arrow-down-circle-fill me-2 text-primary"></i>Ver Produtos em Oferta
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-20 d-inline-block backdrop-blur">
                        <img src="/img/1.jpg" alt="Destaque da Coleção" class="rounded-3 shadow-lg object-fit-cover" style="width: 320px; height: 320px;" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção da Vitrine de Produtos -->
        <section id="vitrine-produtos" class="mb-5">
            <!-- Cabeçalho da vitrine -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-3 border-bottom">
                <div>
                    <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">
                        <i class="bi bi-bag-check me-1"></i> Catálogo Completo
                    </span>
                    <h2 class="h2 fw-bold text-dark mb-1">Destaques da Coleção</h2>
                    <p class="text-secondary mb-0">Peças originais selecionadas com acabamento de alto padrão</p>
                </div>
                <div class="text-muted small mt-2 mt-md-0 fw-semibold bg-white px-3 py-2 rounded-pill border shadow-xs">
                    <i class="bi bi-grid-fill text-primary me-1"></i> <?= count($produtos) ?> produtos disponíveis
                </div>
            </div>

            <!-- Grade de Produtos -->
            <?php if (empty($produtos)): ?>
                <div class="text-center py-5 my-4 bg-white rounded-4 border shadow-xs p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted rounded-circle p-4 mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-inbox fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold text-dark mb-2">Nenhum produto encontrado</h3>
                    <p class="text-secondary mb-4">No momento não encontramos itens disponíveis nesta seção.</p>
                    <a href="/" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        Voltar ao Início
                    </a>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col">
                            <article class="card card-produto shadow-sm">
                                <a href="/produto/<?= (int) $produto->id ?>" class="card-produto-link">
                                    <!-- Wrapper da imagem com zoom e badge -->
                                    <div class="produto-img-wrapper">
                                        <img class="produto-img"
                                            src="/img/<?= (int) $produto->id ?>.jpg"
                                            alt="<?= htmlspecialchars($produto->categoria) ?>: <?= htmlspecialchars($produto->titulo) ?>"
                                            loading="lazy" />

                                        <?php if ($produto->desconto > 0): ?>
                                            <span class="badge-desconto">
                                                <i class="bi bi-arrow-down-short"></i>-<?= (int) $produto->desconto ?>% OFF
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Corpo do Card -->
                                    <div class="card-body d-flex flex-column p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge-tag-categoria">
                                                <i class="bi bi-tag-fill"></i><?= htmlspecialchars($produto->categoria ?: 'Geral') ?>
                                            </span>
                                            <span class="text-muted small">Cód #<?= (int) $produto->id ?></span>
                                        </div>

                                        <h3 class="produto-titulo">
                                            <?= htmlspecialchars($produto->titulo) ?>
                                        </h3>

                                        <!-- Avaliações Sociais (Social Proof) -->
                                        <div class="rating-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                            <span class="rating-count">(<?= 20 + ((int)$produto->id * 3) ?>)</span>
                                        </div>

                                        <!-- Preço e Parcelamento -->
                                        <div class="preco-container">
                                            <?php if ($produto->desconto > 0): ?>
                                                <div class="produto-preco-antigo">
                                                    R$ <?= number_format($produto->preco, 2, ',', '.') ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="produto-preco-atual">
                                                R$ <?= number_format($produto->precoFinal, 2, ',', '.') ?>
                                            </div>

                                            <div class="produto-parcelamento">
                                                ou até 3x de R$ <?= number_format($produto->precoFinal / 3, 2, ',', '.') ?> sem juros
                                            </div>
                                        </div>

                                        <div class="btn-detalhes">
                                            <i class="bi bi-bag-plus-fill"></i> Ver Detalhes
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Anúncio / Banner Patrocinado Opcional -->
        <div class="text-center my-4 py-2 border-top border-bottom border-light-subtle">
            <span class="text-muted small text-uppercase tracking-wider d-block mb-2" style="font-size: 0.65rem;">Publicidade</span>
            <div class="d-inline-block overflow-hidden rounded-3 border bg-light p-1">
                <ins class="adsbygoogle"
                    style="display:inline-block;width:728px;height:90px"
                    data-ad-client="ca-pub-2798607881084626"
                    data-ad-slot="4922914001"></ins>
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