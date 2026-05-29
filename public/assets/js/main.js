// ====== Tianguis SMT UI helpers ======
(function () {
    // Navbar shrink on scroll
    const nav = document.querySelector('.navbar');
    const shrink = () => {
        if (!nav) return;
        if (window.scrollY > 10) nav.classList.add('shrink');
        else nav.classList.remove('shrink');
    };
    shrink();
    window.addEventListener('scroll', shrink);

    // Footer year auto
    const yearEl = document.querySelector('[data-current-year]');
    if (yearEl) yearEl.textContent = new Date().getFullYear();

    // Search form: evita enviar vacío
    const searchForm = document.querySelector('form[action$="locales"]');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            const input = searchForm.querySelector('input[name="q"]');
            if (input && input.value.trim() === '') {
                e.preventDefault();
                showToast('Escribe algo para buscar 😊');
            }
        });
    }

    // Toast simple sin dependencia
    function showToast(msg = 'Listo', ms = 2500) {
        const el = document.createElement('div');
        el.textContent = msg;
        Object.assign(el.style, {
            position: 'fixed', left: '50%', bottom: '28px', transform: 'translateX(-50%)',
            background: '#111827', color: '#fff', padding: '10px 14px',
            borderRadius: '12px', boxShadow: '0 10px 25px rgba(0,0,0,.25)',
            zIndex: 9999, fontSize: '14px', opacity: '0', transition: 'opacity .2s ease'
        });
        document.body.appendChild(el);
        requestAnimationFrame(() => el.style.opacity = '1');
        setTimeout(() => {
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 220);
        }, ms);
    }

    // Exponer para usar en otras vistas si hace falta
    window.tsmt = { showToast };
})();
