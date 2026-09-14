<?php

/** @var \App\DTO\ProdutoHomeDTO[] $produtos */
$nomeLoja = defined('LOJA') ? LOJA : 'Loja Exclusiva';
$nomeCategoria = $nomeCategoria ?? ($titulo ?? (!empty($produtos) ? $produtos[0]->categoria : 'Categoria'));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars(ucfirst((string) $nomeCategoria)) ?> - <?= htmlspecialchars((string) $nomeLoja) ?></title>
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

        <!-- Navegação Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-store mb-0 align-items-center">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none">
                        <i class="bi bi-house-door me-1"></i>Início
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="text-secondary">Categorias</span>
                </li>
                <li class="breadcrumb-item active text-capitalize" aria-current="page">
                    <?= htmlspecialchars($nomeCategoria) ?>
                </li>
            </ol>
        </nav>

        <!-- Cabeçalho da Categoria -->
        <section class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-3 border-bottom">
            <div>
                <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">
                    <i class="bi bi-tag-fill me-1"></i> Categoria Selecionada
                </span>
                <h1 class="h2 fw-bold text-dark mb-1 text-capitalize">
                    <?= htmlspecialchars($nomeCategoria) ?>
                </h1>
                <p class="text-secondary mb-0">
                    Confira as melhores opções em <?= htmlspecialchars(strtolower($nomeCategoria)) ?> com acabamento e corte de alto padrão
                </p>
            </div>
            <div class="text-muted small mt-2 mt-md-0 fw-semibold bg-white px-3 py-2 rounded-pill border shadow-xs">
                <i class="bi bi-grid-fill text-primary me-1"></i> <?= !empty($produtos) ? count($produtos) : 0 ?> produtos encontrados
            </div>
        </section>

        <!-- Grade de Produtos -->
        <section class="mb-5">
            <?php if (empty($produtos)): ?>
                <div class="text-center py-5 my-4 bg-white rounded-4 border shadow-xs p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted rounded-circle p-4 mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-inbox fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold text-dark mb-2">Nenhum produto encontrado nesta categoria</h3>
                    <p class="text-secondary mb-4">No momento não há peças cadastradas para este departamento.</p>
                    <a href="/" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Explorar Todos os Produtos
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

                                        <h2 class="produto-titulo">
                                            <?= htmlspecialchars($produto->titulo) ?>
                                        </h2>

                                        <!-- Avaliações Sociais -->
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

    </main>

    <!-- Inclusão do rodapé -->
    <?php include __DIR__ . '/partials/rodape.inc.php'; ?>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Script personalizado da loja -->
    <script src="/assets/js/main.js"></script>
</body>

</html>