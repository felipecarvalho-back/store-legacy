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

    <main class="container py-4">

        <!-- Inclusão do menu de navegação -->
        <?php include 'menu.inc.php'; ?>

        <!-- Anúncio / Banner publicitário -->
        <div class="banner-ad">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                style="display:inline-block;width:728px;height:90px"
                data-ad-client="ca-pub-2798607881084626"
                data-ad-slot="4922914001"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <!-- Cabeçalho da vitrine -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-2 border-bottom">
            <div>
                <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">
                    <i class="bi bi-stars me-1"></i> Seleção Especial
                </span>
                <h1 class="h2 fw-bold text-dark mb-1">Destaques da Coleção</h1>
                <p class="text-secondary mb-0">Peças selecionadas com qualidade superior e descontos exclusivos</p>
            </div>
            <div class="text-muted small mt-2 mt-md-0">
                <i class="bi bi-grid-fill me-1"></i> <?= count($produtos) ?> produtos disponíveis
            </div>
        </div>

        <!-- Grade de Produtos com Bootstrap Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
            <?php foreach ($produtos as $produto): ?>
                <div class="col">
                    <div class="card h-100 card-produto shadow-sm">
                        <a href="/produtos.php?cod=<?= (int) $produto->id ?>" class="card-produto-link">
                            <!-- Wrapper da imagem com zoom e badge -->
                            <div class="produto-img-wrapper">
                                <img class="produto-img" 
                                     src="/img/<?= (int) $produto->id ?>.jpg" 
                                     alt="<?= htmlspecialchars($produto->categoria) ?>: <?= htmlspecialchars($produto->titulo) ?>" 
                                     loading="lazy" />
                                
                                <?php if ($produto->desconto > 0): ?>
                                    <span class="badge-desconto">
                                        <i class="bi bi-arrow-down-short"></i>-<?= (int) $produto->desconto ?>%
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Corpo do Card -->
                            <div class="card-body d-flex flex-column p-4">
                                <span class="produto-categoria-tag mb-1">
                                    <i class="bi bi-tag-fill me-1"></i><?= htmlspecialchars($produto->categoria ?: 'Geral') ?>
                                </span>
                                
                                <h2 class="produto-titulo">
                                    <?= htmlspecialchars($produto->titulo) ?>
                                </h2>

                                <div class="mt-auto pt-3 border-top">
                                    <?php if ($produto->desconto > 0): ?>
                                        <div class="produto-preco-antigo">
                                            R$ <?= number_format($produto->preco, 2, ',', '.') ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="produto-preco-atual">
                                        R$ <?= number_format($produto->precoFinal, 2, ',', '.') ?>
                                    </div>
                                </div>

                                <div class="btn-detalhes mt-3">
                                    <i class="bi bi-bag-plus-fill me-1"></i> Ver Detalhes
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <!-- Inclusão do rodapé -->
    <?php include 'rodape.inc.php'; ?>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Script personalizado da loja -->
    <script src="/assets/js/main.js"></script>
</body>

</html>