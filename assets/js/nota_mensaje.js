function initNotaCampo(campo) {
    const version = campo.closest('[data-nota-version]')?.dataset.notaVersion;
    const clave = campo.dataset.notaCampo;
    const storageKey = version ? `nota:${version}:${clave}` : `qdtm02P${clave}`;
    const input = campo.querySelector('[data-nota-input]');
    const respuesta = campo.querySelector('[data-nota-respuesta]');
    const estrella = campo.querySelector('[data-nota-estrella]');

    function mostrarRespuesta(valor) {
        respuesta.textContent = valor;
        respuesta.hidden = false;
        input.hidden = true;
    }

    try {
        const guardado = JSON.parse(localStorage.getItem(storageKey));
        if (typeof guardado === 'string' && guardado !== '') {
            input.value = guardado;
            mostrarRespuesta(guardado);
        }
    } catch {
        // The field remains usable when browser storage is unavailable.
    }

    estrella.addEventListener('click', () => {
        if (!respuesta.hidden) {
            respuesta.hidden = true;
            input.hidden = false;
            input.focus();
            return;
        }

        const valor = input.value.trim();
        if (valor === '') {
            input.placeholder = 'Aquí debés completar la idea';
            input.focus();
            return;
        }

        mostrarRespuesta(valor);
        try {
            localStorage.setItem(storageKey, JSON.stringify(valor));
        } catch {
            // Keep the answer visible for this page visit.
        }
    });
}

function initNota() {
    document.querySelectorAll('[data-nota-campo]').forEach(initNotaCampo);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNota, {once: true});
} else {
    initNota();
}
