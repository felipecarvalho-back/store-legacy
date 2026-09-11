/**
 * Script de inicialização e interações modernas da loja
 */
document.addEventListener('DOMContentLoaded', () => {
    // Inicializa tooltips do Bootstrap caso existam
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    }

    // Fallback elegante para imagens que falharem no carregamento
    const fallbackSvg = `data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300"><rect fill="%23f1f5f9" width="300" height="300"/><text fill="%2394a3b8" font-family="sans-serif" font-size="14" dy="5" font-weight="bold" x="50%" y="50%" text-anchor="middle">Imagem indisponível</text></svg>`;

    document.querySelectorAll('.produto-img').forEach(img => {
        img.addEventListener('error', function () {
            if (this.src !== fallbackSvg) {
                this.src = fallbackSvg;
            }
        });
    });
});
