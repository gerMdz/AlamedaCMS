    $(function () {
    const pcentral = localStorage.getItem("NotaPcentral");
    const puno = localStorage.getItem("NotaPuno");
    const pdos = localStorage.getItem("NotaPdos");
    const ptres = localStorage.getItem("NotaPtres");
    const pcuatro = localStorage.getItem("NotaPcuatro");
    if (pcentral != null) {
    $('#pcentral').val(JSON.parse(localStorage.NotaPcentral))
    muestra1('#lpcentral', '#sinpcentral')
    aceptado('central');
} else {
    oculta1('#lpcentral', '#sinpcentral')
}

    if (puno != null) {
    $('#puno').val(JSON.parse(localStorage.NotaPuno))
    muestra1('#lpuno', '#sinpuno')
    aceptado('uno');
} else {
    oculta1('#lpuno', '#sinpuno')
}

    if (pdos != null) {
    $('#pdos').val(JSON.parse(localStorage.NotaPdos))
    muestra1('#lpdos', '#sinpdos')
    aceptado('dos');
} else {
    oculta1('#lpdos', '#sinpdos')
}

    if (ptres != null) {
    $('#ptres').val(JSON.parse(localStorage.NotaPtres))
    muestra1('#lptres', '#sinptres')
    aceptado('tres');
} else {
    oculta1('#lptres', '#sinptres')
}

    if (pcuatro != null) {
    $('#pcuatro').val(JSON.parse(localStorage.NotaPcuatro))
    muestra1('#lpcuatro', '#sinpcuatro')
    aceptado('cuatro');
} else {
    oculta1('#lpcuatro', '#sinpcuatro')
}

});

    $(function () {
    $('#xpcentral').click(function () {
        const pcentral = $('#pcentral').val();
        if (pcentral == null || pcentral == '') {
            $('#pcentral').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('central')
        $('#xpcentral').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcentral')) {
            console.log('centra visible')
            muestra1('#sinpcentral', '#lpcentral')
        } else {
            console.log('centra hidden')
            aceptado('central')
            oculta1('#sinpcentral', '#lpcentral')
        }
    });

    $('#xpuno').click(function () {
    const puno = $('#puno').val();
    if (puno == null || puno == '') {
    $('#puno').attr('placeholder', 'Aquí debés completar la idea');
    return false;
}
    procesa('uno')
    $('#xpuno').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
    if (esVisible('#lpuno')) {
    muestra1('#sinpuno', '#lpuno')
} else {
    aceptado('uno')
    oculta1('#sinpuno', '#lpuno')
}
});

    $('#xpdos').click(function () {
    const pdos = $('#pdos').val();
    if (pdos == null || pdos == '') {
    $('#pdos').attr('placeholder', 'Aquí debés completar la idea');
    return false;
}
    procesa('dos')
    $('#xpdos').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
    if (esVisible('#lpdos')) {
    muestra1('#sinpdos', '#lpdos')
} else {
    aceptado('dos')
    oculta1('#sinpdos', '#lpdos')
}
});

    $('#xptres').click(function () {
    const ptres = $('#ptres').val();
    if (ptres == null || ptres == '') {
    $('#ptres').attr('placeholder', 'Aquí debés completar la idea');
    return false;
}
    procesa('tres')
    $('#xptres').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
    if (esVisible('#lptres')) {
    muestra1('#sinptres', '#lptres')
} else {
    aceptado('tres')
    oculta1('#sinptres', '#lptres')
}
});

    $('#xpcuatro').click(function () {
    const pcuatro = $('#pcuatro').val();
    if (pcuatro == null || pcuatro == '') {
    $('#pcuatro').attr('placeholder', 'Aquí debés completar la idea');
    return false;
}
    procesa('cuatro')
    $('#xpcuatro').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
    if (esVisible('#lpcuatro')) {
    muestra1('#sinpcuatro', '#lpcuatro')
} else {
    aceptado('cuatro')
    oculta1('#sinpcuatro', '#lpcuatro')
}
});

});


    function procesa(p) {
    console.log('p = ' + p)
    if (p === 'central') {
    const pcentral = $('#pcentral').val();
    localStorage.NotaPcentral = JSON.stringify(pcentral);
}

    if (p === 'uno') {
    const puno = $('#puno').val();
    localStorage.NotaPuno = JSON.stringify(puno);
}

    if (p === 'dos') {
    const pdos = $('#pdos').val();
    localStorage.NotaPdos = JSON.stringify(pdos);
}

    if (p === 'tres') {
    const ptres = $('#ptres').val();
    localStorage.NotaPtres = JSON.stringify(ptres);
}

    if (p === 'cuatro') {
    const pcuatro = $('#pcuatro').val();
    localStorage.NotaPcuatro = JSON.stringify(pcuatro);
}

}

    function aceptado(p) {


    if (p === 'uno') {
    const puno = JSON.parse(localStorage.NotaPuno);

    $('#lpuno').addClass('fontTahu fa-2x text-info');
    $('#lpuno').html(puno);
    $('#sinpuno').hide();
}
    if (p === 'central') {
    console.log('aceptado = ' + p)
    const pcentral = JSON.parse(localStorage.NotaPcentral);
    $('#lpcentral').addClass('fontTahu fa-2x text-info');
    $('#lpcentral').html(pcentral);
    $('#lpcentral').show();
    $('#sinpcentral').hide();
}
    if (p === 'dos') {
    const pdos = JSON.parse(localStorage.NotaPdos);

    $('#lpdos').addClass('fontTahu fa-2x text-info');
    $('#lpdos').html(pdos);
    $('#sinpdos').hide();
}
    if (p === 'tres') {
    const ptres = JSON.parse(localStorage.NotaPtres);

    $('#lptres').addClass('fontTahu fa-2x text-info');
    $('#lptres').html(ptres);
    $('#sinptres').hide();
}
    if (p === 'cuatro') {
    const pcuatro = JSON.parse(localStorage.NotaPcuatro);

    $('#lpcuatro').addClass('fontTahu fa-2x text-info');
    $('#lpcuatro').html(pcuatro);
    $('#sinpcuatro').hide();
}

}

    /**
    * Comprueba si un elemento es visible o no
    *
    * @param elemento
    */

    function esVisible(elemento) {
    let esVisible = false;
    if ($(elemento).is(':visible') && $(elemento).css("visibility") != "hidden"
    && $(elemento).css("opacity") > 0) {
    esVisible = true;
}

    return esVisible;
};

    function muestra1(elemento1, elemento2) {
    $(elemento1).show()
    $(elemento2).hide()
}

    function oculta1(elemento1, elemento2) {
    $(elemento1).hide()
    $(elemento2).show()
}


    // Ejecuta la funcion solo si el elemento esta visible

