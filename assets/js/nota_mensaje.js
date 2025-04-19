import $ from 'jquery';

const claves = [
    'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez',
    'once', 'doce', 'trece', 'catorce', 'quince', 'dieciseis', 'diecisiete',
    'dieciocho', 'diecinueve', 'veinte', 'veintiuno', 'veintidos'
];

$(function () {
    claves.forEach(clave => {
        const valor = localStorage.getItem(`tocar07P${clave}`);
        const $input = $(`#p${clave}`);
        const $label = $(`#lp${clave}`);
        const $container = $(`#sinp${clave}`);
        const $icon = $(`#xp${clave}`);

        // Si hay valor en localStorage, lo cargamos
        if (valor !== null) {
            $input.val(JSON.parse(valor));
            muestra1($label, $container);
            aceptado(clave);
        } else {
            oculta1($label, $container);
        }

        // Acción del ícono (estrella)
        $icon.on('click', () => {
            const val = $input.val();
            if (!val) {
                $input.attr('placeholder', 'Aquí debés completar la idea');
                return;
            }

            procesa(clave);
            $icon.toggleClass('fa-star-o fa-star');

            if (esVisible($label)) {
                muestra1($container, $label);
            } else {
                aceptado(clave);
                oculta1($container, $label);
            }
        });
    });
});

function procesa(clave) {
    const val = $(`#p${clave}`).val();
    localStorage.setItem(`tocar07P${clave}`, JSON.stringify(val));
}

function aceptado(clave) {
    const val = JSON.parse(localStorage.getItem(`tocar07P${clave}`));
    const $label = $(`#lp${clave}`);
    const $container = $(`#sinp${clave}`);
    $label.addClass('fontTahu fa-2x text-info').html(val);
    $container.hide();
}

function muestra1(selector1, selector2) {
    $(selector1).show();
    $(selector2).hide();
}

function oculta1(selector1, selector2) {
    $(selector1).hide();
    $(selector2).show();
}

function esVisible(el) {
    const $el = $(el);
    return $el.is(':visible') && $el.css("visibility") !== "hidden" && parseFloat($el.css("opacity")) > 0;
}
