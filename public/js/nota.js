$(function () {
    const puno = localStorage.getItem("ComunidadPuno");
    const pdos = localStorage.getItem("ComunidadPdos");
    const ptres = localStorage.getItem("ComunidadPtres");
    const pcuatro = localStorage.getItem("ComunidadPcuatro");
    const pcinco = localStorage.getItem("ComunidadPcinco");
    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.ComunidadPcinco))
        muestra1('#lpcinco', '#sinpcinco')
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco')
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.ComunidadPuno))
        muestra1('#lpuno', '#sinpuno')
        aceptado('uno');
        console.log('19')
    } else {
        oculta1('#lpuno', '#sinpuno')
        console.log('21')
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.ComunidadPdos))
        muestra1('#lpdos', '#sinpdos')
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos')
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.ComunidadPtres))
        muestra1('#lptres', '#sinptres')
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres')
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.ComunidadPcuatro))
        muestra1('#lpcuatro', '#sinpcuatro')
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro')
    }

});

$(function () {
    $('#xpcinco').click(function () {
        const pcinco = $('#pcinco').val();
        if (pcinco == null || pcinco == '') {
            $('#pcinco').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('cinco')
        $('#xpcinco').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcinco')) {
            console.log('cinco visible')
            muestra1('#sinpcinco', '#lpcinco')
        } else {
            console.log('cinco hidden')
            aceptado('cinco')
            oculta1('#sinpcinco', '#lpcinco')
        }
    });

    $('#xpuno').click(function () {
        console.log('71')
        const puno = $('#puno').val();
        console.log(puno  + '73')
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
    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.ComunidadPcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.ComunidadPuno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.ComunidadPdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.ComunidadPtres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.ComunidadPcuatro = JSON.stringify(pcuatro);
    }

}

function aceptado(p) {


    if (p === 'uno') {
        const puno = JSON.parse(localStorage.ComunidadPuno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        console.log('aceptado = ' + p)
        const pcinco = JSON.parse(localStorage.ComunidadPcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.ComunidadPdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.ComunidadPtres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.ComunidadPcuatro);

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

