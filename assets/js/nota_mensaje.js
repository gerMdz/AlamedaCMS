import $ from 'jquery';
$(function () {
    // Seleccionar todas las inputs dentro de las etiquetas con id que comienza con "p"
    let inputs = $('input[id^="p"]');

    // Iterar sobre cada input
    inputs.each(function() {
        let valor = localStorage.getItem(`tocar05P${this.id}`);

        if (valor) {
            const id = this.id.slice(1); // Remover el "p" del inicio de id
            $(`#${id}`).val(JSON.parse(localStorage[`tocar05P${id}`]));
            muestra1(`#l${id}`, `#sin${id}`);
            aceptado(id);
        } else {
            const id = this.id.slice(1); // Remover el "p" del inicio de id
            oculta1(`#l${id}`, `#sin${id}`);
        }
    });
});

function esVisible(elemento) {
    let esVisible = false;
    if ($(elemento).is(':visible') && $(elemento).css("visibility") != "hidden" && $(elemento).css("opacity") > 0) {
        esVisible = true;
    }
    return esVisible;
}

function muestra1(elementO2, elemento2) {
    $(elementO2).show();
    $(elemento2).hide();
}

function oculta1(elementO2, elemento2) {
    $(elementO2).hide();
    $(elemento2).show();
}
