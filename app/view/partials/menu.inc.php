<?php
/** @var \App\Entity\Categoria[]|array[] $categorias */
$nomeLoja = defined('LOJA') ? LOJA : 'Loja Exclusiva';
$listaCategorias = $categorias ?? [];

$itensCarrinho = 0;
if (!empty($_COOKIE['carrinho'])) {
    $itensCarrinho = count(array_filter(explode(',', (string) $_COOKIE['carrinho'])));
}
?>

<!-- Barra de Benefícios Superior -->
<div class="top-notice-bar d-none d-md-block mb-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="badge bg-primary px-2 py-1 me-2 rounded-pill fw-bold">NOVIDADE</span>
            <span>Frete Grátis acima de R$ 199 para todo o país</span>
            <span class="bullet-dot"></span>
            <span>Parcele em até 10x sem juros</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="/central-de-atendimento" class="top-notice-link text-decoration-none">
                <i class="bi bi-headset me-1"></i>Atendimento
            </a>
            <span class="text-secondary opacity-50">|</span>
            <span class="text-white-50"><i class="bi bi-shield-check me-1 text-success"></i>Compra 100% Segura</span>
        </div>
    </div>
</div>

<!-- Header com Navbar Sticky Translúcida -->
<div class="header-sticky-wrapper">
    <nav class="navbar navbar-expand-lg navbar-store" aria-label="Navegação Principal da Loja">
        <div class="container-fluid px-0">
            <!-- Marca / Logo da Loja -->
            <a class="navbar-brand d-flex align-items-center me-4 py-0" href="/" title="<?= htmlspecialchars($nomeLoja) ?>">
                <div class="brand-badge-icon me-2">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
                <div class="d-flex flex-column">
                    <span class="brand-title"><?= htmlspecialchars($nomeLoja) ?></span>
                    <span class="brand-subtitle">Store &amp; Lifestyle</span>
                </div>
            </a>

            <!-- Botão Hamburguer Mobile -->
            <button class="navbar-toggler border-0 shadow-none p-2 rounded-3 bg-light" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarLojaMenu" 
                    aria-controls="navbarLojaMenu" 
                    aria-expanded="false" 
                    aria-label="Abrir menu de navegação">
                <i class="bi bi-list fs-3 text-dark"></i>
            </button>

            <!-- Links e Categorias -->
            <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarLojaMenu">
                <ul class="navbar-nav me-auto mb-3 mb-lg-0 align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-store <?= (!isset($categoria_id) || empty($categoria_id)) ? 'active' : '' ?>" 
                           href="/" 
                           <?= (!isset($categoria_id) || empty($categoria_id)) ? 'aria-current="page"' : '' ?>>
                            <i class="bi bi-grid-fill me-1 small"></i>Todos os Produtos
                        </a>
                    </li>

                    <?php foreach ($listaCategorias as $categoria): ?>
                        <?php
                        $idCat = is_object($categoria) ? (int) $categoria->id : (int) $categoria['id'];
                        $tituloCat = is_object($categoria) ? (string) $categoria->titulo : (string) $categoria['titulo'];
                        $selecionado = isset($categoria_id) && (int) $categoria_id === $idCat;
                        ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-store <?= $selecionado ? 'active' : '' ?>" 
                               href="/categoria/<?= $idCat ?>" 
                               title="Ver categoria <?= htmlspecialchars($tituloCat) ?>"
                               <?= $selecionado ? 'aria-current="page"' : '' ?>>
                                <?= htmlspecialchars(ucfirst($tituloCat)) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Ações da Direita (Carrinho) -->
                <div class="d-flex align-items-center gap-2 pt-2 pt-lg-0 border-top border-lg-0">
                    <a class="btn-carrinho" href="/carrinho.php" title="Ver meu carrinho de compras">
                        <i class="bi bi-bag-fill fs-6"></i>
                        <span>Sacola</span>
                        <?php if ($itensCarrinho > 0): ?>
                            <span class="carrinho-badge ms-1"><?= $itensCarrinho ?></span>
                        <?php else: ?>
                            <span class="carrinho-badge ms-1">0</span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>