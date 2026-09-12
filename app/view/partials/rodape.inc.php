<?php
$nomeLoja = defined('LOJA') ? LOJA : ($titulo ?? 'Loja');
?>
<footer class="rodape bg-dark text-white-50 py-5 mt-5 border-top border-secondary border-opacity-25" data-bs-theme="dark">
    <div class="container">
        <div class="row gy-4 justify-content-between">
            <!-- Coluna 1: Loja e Institucional -->
            <div class="col-12 col-md-5 col-lg-4">
                <h5 class="text-white fw-bold mb-3">
                    <a href="/" class="text-white text-decoration-none d-inline-flex align-items-center">
                        <i class="bi bi-shop me-2 text-primary fs-4"></i>
                        <span><?= htmlspecialchars($nomeLoja) ?></span>
                    </a>
                </h5>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="/quem-somos" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Quem Somos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/termos-de-uso" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Termos de Uso
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/central-de-atendimento" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Central de Atendimento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/vale-presente" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Vale Presente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/carrinho.php" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-cart3 me-1"></i>Carrinho
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/seja-um-revendedor" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Seja um Revendedor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sala-de-imprensa" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-chevron-right small me-1"></i>Sala de Imprensa
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Coluna 2: Participe -->
            <div class="col-12 col-md-4 col-lg-3">
                <h6 class="text-white text-uppercase fw-bold mb-3">
                    <i class="bi bi-people-fill me-2 text-primary"></i>Participe
                </h6>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="/mande-sua-foto" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-camera me-2"></i>Mande a sua foto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/vote" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-hand-thumbs-up me-2"></i>Vote na melhor camisa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/compartilhe" class="nav-link p-0 text-white-50 link-light">
                            <i class="bi bi-share me-2"></i>Indique a um amigo
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Coluna 3: Formas de Pagamento e Selos -->
            <div class="col-12 col-md-3 col-lg-3">
                <h6 class="text-white text-uppercase fw-bold mb-3">
                    <i class="bi bi-credit-card-2-front me-2 text-primary"></i>Formas de Pagamento
                </h6>
                <p class="text-white-50 small mb-2">Aceitamos</p>
                <div class="p-2 bg-white rounded shadow-sm d-inline-block">
                    <img src="/img/bandeiras.gif" alt="Trabalhamos com vários cartões" class="img-fluid" />
                </div>
            </div>
        </div>

        <!-- Linha inferior com Direitos Autorais e Redes Sociais -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center pt-4 mt-5 border-top border-secondary border-opacity-25 text-white-50 small">
            <p class="mb-2 mb-sm-0">&copy; <?= date('Y') ?> <?= htmlspecialchars($nomeLoja) ?>. Todos os direitos reservados.</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-white-50 link-light fs-5" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white-50 link-light fs-5" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white-50 link-light fs-5" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
            </div>
        </div>
    </div>
</footer>
