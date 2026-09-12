<?php
/** @var \App\Entity\Categoria[]|array[] $categorias */
$nomeLoja = defined('LOJA') ? LOJA : ($titulo ?? 'Loja');
$listaCategorias = $categorias ?? [];

$itensCarrinho = 0;
if (!empty($_COOKIE['carrinho'])) {
    $itensCarrinho = count(array_filter(explode(',', (string) $_COOKIE['carrinho'])));
}
?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm rounded-4 border px-3 py-2 mb-4" aria-label="Navegação principal">
    <div class="container-fluid px-0">
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center me-3" href="/" title="<?= htmlspecialchars($nomeLoja) ?>">
            <i class="bi bi-shop me-2 text-primary fs-4"></i>
            <span><?= htmlspecialchars($nomeLoja) ?></span>
        </a>

        <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLoja" aria-controls="navbarLoja" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarLoja">
            <div class="vr d-none d-lg-block me-3 my-auto text-secondary opacity-25" style="height: 24px;"></div>

            <ul class="navbar-nav nav-pills me-auto mb-2 mb-lg-0 align-items-lg-center gap-1">
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 <?= (!isset($categoria_id) || empty($categoria_id)) ? 'active' : 'text-secondary' ?>" 
                       href="/" 
                       <?= (!isset($categoria_id) || empty($categoria_id)) ? 'aria-current="page"' : '' ?>>
                        <i class="bi bi-house-door me-1"></i>Início
                    </a>
                </li>

                <?php foreach ($listaCategorias as $categoria): ?>
                    <?php
                    $idCat = is_object($categoria) ? (int) $categoria->id : (int) $categoria['id'];
                    $tituloCat = is_object($categoria) ? (string) $categoria->titulo : (string) $categoria['titulo'];
                    $selecionado = isset($categoria_id) && (int) $categoria_id === $idCat;
                    ?>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3 <?= $selecionado ? 'active' : 'text-secondary' ?>" 
                           href="/categorias.php?cod=<?= $idCat ?>" 
                           title="<?= htmlspecialchars($tituloCat) ?>"
                           <?= $selecionado ? 'aria-current="page"' : '' ?>>
                            <?= htmlspecialchars($tituloCat) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Botão do Carrinho -->
            <div class="d-flex align-items-center ms-lg-auto my-2 my-lg-0">
                <?php if ($itensCarrinho > 0): ?>
                    <a class="btn btn-primary btn-sm rounded-pill d-inline-flex align-items-center px-3 py-2 shadow-sm" href="/carrinho.php">
                        <i class="bi bi-cart3 me-1 fs-6"></i>
                        <span>Carrinho</span>
                        <span class="badge bg-white text-primary rounded-pill ms-2 fw-bold">
                            <?= $itensCarrinho ?>
                        </span>
                    </a>
                <?php else: ?>
                    <a class="btn btn-outline-secondary btn-sm rounded-pill d-inline-flex align-items-center px-3 py-2" href="/carrinho.php">
                        <i class="bi bi-cart3 me-1 fs-6"></i>
                        <span>Carrinho</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>