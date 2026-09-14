<?php
$nomeLoja = defined('LOJA') ? LOJA : 'Loja Exclusiva';
?>

<!-- Faixa de Vantagens da Loja (Pré-Rodapé) -->
<section class="footer-benefits-strip" aria-label="Garantias da Loja">
    <div class="container">
        <div class="row g-4 justify-content-between">
            <div class="col-6 col-lg-3">
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Frete Rápido</h6>
                        <small class="text-secondary">Em até 24h para capitais</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Até 10x Sem Juros</h6>
                        <small class="text-secondary">Ou 5% de desconto no Pix</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Compra Protegida</h6>
                        <small class="text-secondary">Dados 100% criptografados</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Primeira Troca Grátis</h6>
                        <small class="text-secondary">Até 30 dias após a entrega</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rodapé Principal -->
<footer class="rodape" data-bs-theme="dark">
    <div class="container">
        
        <!-- Bloco Newsletter -->
        <div class="footer-newsletter-box">
            <div class="row align-items-center g-3">
                <div class="col-lg-6">
                    <span class="badge bg-primary px-3 py-1 rounded-pill fw-bold mb-2">CLUBE VIP</span>
                    <h4 class="fw-bold text-white mb-1">Receba 10% OFF na primeira compra</h4>
                    <p class="text-white-50 mb-0 small">Cadastre seu melhor e-mail e fique por dentro de lançamentos e ofertas relâmpago.</p>
                </div>
                <div class="col-lg-6">
                    <form class="d-flex flex-column flex-sm-row gap-2" onsubmit="event.preventDefault(); alert('Obrigado por se inscrever!');">
                        <input type="email" class="form-control rounded-pill px-3 py-2 bg-white text-dark border-0" placeholder="Digite seu melhor e-mail..." required>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold text-nowrap">
                            <i class="bi bi-send-fill me-1"></i> Quero meu cupom
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Colunas de Links -->
        <div class="row gy-4 justify-content-between mb-5">
            <!-- Coluna 1: Loja e Contato -->
            <div class="col-12 col-md-4 col-lg-3">
                <h5 class="fw-bold mb-3">
                    <a href="/" class="text-white text-decoration-none d-inline-flex align-items-center">
                        <div class="brand-badge-icon me-2" style="width: 32px; height: 32px; font-size: 1rem;">
                            <i class="bi bi-bag-check-fill"></i>
                        </div>
                        <span class="fs-5"><?= htmlspecialchars($nomeLoja) ?></span>
                    </a>
                </h5>
                <p class="text-white-50 small mb-3">
                    Sua loja de referência em estilo, qualidade e conforto. Peças exclusivas pensadas para o seu dia a dia.
                </p>
                <div class="d-flex flex-column gap-2 small text-white-50">
                    <div><i class="bi bi-headset text-primary me-2"></i>(11) 4002-8922</div>
                    <div><i class="bi bi-envelope text-primary me-2"></i>contato@<?= strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nomeLoja)) ?>.com.br</div>
                    <div><i class="bi bi-clock text-primary me-2"></i>Seg. a Sex. das 09h às 18h</div>
                </div>
            </div>

            <!-- Coluna 2: Institucional -->
            <div class="col-6 col-md-4 col-lg-2">
                <h6 class="footer-column-title">Institucional</h6>
                <ul class="nav flex-column gap-2">
                    <li><a href="/quem-somos" class="footer-link"><i class="bi bi-chevron-right small"></i>Quem Somos</a></li>
                    <li><a href="/termos-de-uso" class="footer-link"><i class="bi bi-chevron-right small"></i>Termos de Uso</a></li>
                    <li><a href="/central-de-atendimento" class="footer-link"><i class="bi bi-chevron-right small"></i>Atendimento</a></li>
                    <li><a href="/vale-presente" class="footer-link"><i class="bi bi-chevron-right small"></i>Vale Presente</a></li>
                    <li><a href="/seja-um-revendedor" class="footer-link"><i class="bi bi-chevron-right small"></i>Revendedores</a></li>
                </ul>
            </div>

            <!-- Coluna 3: Participe -->
            <div class="col-6 col-md-4 col-lg-2">
                <h6 class="footer-column-title">Comunidade</h6>
                <ul class="nav flex-column gap-2">
                    <li><a href="/mande-sua-foto" class="footer-link"><i class="bi bi-camera small"></i>Mande sua Foto</a></li>
                    <li><a href="/vote" class="footer-link"><i class="bi bi-hand-thumbs-up small"></i>Vote no Look</a></li>
                    <li><a href="/compartilhe" class="footer-link"><i class="bi bi-share small"></i>Indique Amigos</a></li>
                    <li><a href="/sala-de-imprensa" class="footer-link"><i class="bi bi-newspaper small"></i>Imprensa</a></li>
                    <li><a href="/carrinho.php" class="footer-link"><i class="bi bi-cart3 small"></i>Minha Sacola</a></li>
                </ul>
            </div>

            <!-- Coluna 4: Formas de Pagamento e Segurança -->
            <div class="col-12 col-md-6 col-lg-4">
                <h6 class="footer-column-title">Formas de Pagamento</h6>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="payment-method-pill"><i class="bi bi-qr-code text-success"></i> Pix</span>
                    <span class="payment-method-pill"><i class="bi bi-credit-card text-primary"></i> Cartão de Crédito</span>
                    <span class="payment-method-pill"><i class="bi bi-upc-scan text-dark"></i> Boleto</span>
                </div>

                <div class="p-2 bg-white rounded shadow-sm d-inline-block mb-3">
                    <img src="/img/bandeiras.gif" alt="Bandeiras de cartões aceitas" class="img-fluid" style="max-height: 28px;" />
                </div>

                <h6 class="footer-column-title mt-2 mb-2" style="font-size: 0.82rem;">Segurança e Certificação</h6>
                <div class="d-flex align-items-center gap-3 text-white-50 small">
                    <div class="d-flex align-items-center gap-1">
                        <i class="bi bi-shield-lock-fill text-success fs-5"></i>
                        <span>SSL 256-Bit Criptografado</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linha inferior com Direitos e Redes Sociais -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-25 text-white-50 small">
            <p class="mb-2 mb-sm-0">&copy; <?= date('Y') ?> <?= htmlspecialchars($nomeLoja) ?>. Todos os direitos reservados. CNPJ 00.000.000/0001-00</p>
            
            <div class="d-flex gap-2">
                <a href="#" class="social-circle-btn" aria-label="Instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-circle-btn" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-circle-btn" aria-label="Twitter / X" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="social-circle-btn" aria-label="WhatsApp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</footer>

