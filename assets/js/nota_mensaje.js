import $ from 'jquery';
$(function () {
    const puno = localStorage.getItem("EsperanzaPuno");
    const pdos = localStorage.getItem("EsperanzaPdos");
    const ptres = localStorage.getItem("EsperanzaPtres");
    const pcuatro = localStorage.getItem("EsperanzaPcuatro");
    const pcinco = localStorage.getItem("EsperanzaPcinco");
    const pseis = localStorage.getItem("EsperanzaPseis");
    const psiete = localStorage.getItem("EsperanzaPsiete");

    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.EsperanzaPcinco))
        muestra1('#lpcinco', '#sinpcinco')
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco')
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.EsperanzaPuno))
        muestra1('#lpuno', '#sinpuno')
        aceptado('uno');
        console.log('19')
    } else {
        oculta1('#lpuno', '#sinpuno')
        console.log('21')
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.EsperanzaPdos))
        muestra1('#lpdos', '#sinpdos')
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos')
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.EsperanzaPtres))
        muestra1('#lptres', '#sinptres')
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres')
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.EsperanzaPcuatro))
        muestra1('#lpcuatro', '#sinpcuatro')
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro')
    }

    if (pseis != null) {
        $('#pseis').val(JSON.parse(localStorage.EsperanzaPseis))
        muestra1('#lpseis', '#sinpseis')
        aceptado('seis');
    } else {
        oculta1('#lpseis', '#sinpseis')
    }
    if (psiete != null) {
        $('#psiete').val(JSON.parse(localStorage.EsperanzaPsiete))
        muestra1('#lpsiete', '#sinpsiete')
        aceptado('siete');
    } else {
        oculta1('#lpsiete', '#sinpsiete')
    }


});

$(function () {
    $('#xpsiete').click(function () {
        const psiete = $('#psiete').val();
        if (psiete == null || psiete == '') {
            $('#psiete').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('siete')
        $('#xpsiete').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpsiete')) {
            console.log('siete visible')
            muestra1('#sinpsiete', '#lpsiete')
        } else {
            console.log('siete hidden')
            aceptado('siete')
            oculta1('#sinpsiete', '#lpsiete')
        }
    });

    $('#xpseis').click(function () {
        const pseis = $('#pseis').val();
        if (pseis == null || pseis == '') {
            $('#pseis').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('seis')
        $('#xpseis').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpseis')) {
            console.log('seis visible')
            muestra1('#sinpseis', '#lpseis')
        } else {
            console.log('seis hidden')
            aceptado('seis')
            oculta1('#sinpseis', '#lpseis')
        }
    });

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
        console.log('xpuno 71')
        const puno = $('#puno').val();
        console.log(puno + '73')
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
    if (p === 'siete') {
        const psiete = $('#psiete').val();
        localStorage.EsperanzaPsiete = JSON.stringify(psiete);
    }

    if (p === 'seis') {
        const pseis = $('#pseis').val();
        localStorage.EsperanzaPseis = JSON.stringify(pseis);
    }

    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.EsperanzaPcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.EsperanzaPuno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.EsperanzaPdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.EsperanzaPtres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.EsperanzaPcuatro = JSON.stringify(pcuatro);
    }

}

function aceptado(p) {

    console.log('aceptado' + p);

    if (p === 'seis') {
        const pseis = JSON.parse(localStorage.EsperanzaPseis);

        $('#lpseis').addClass('fontTahu fa-2x text-info');
        $('#lpseis').html(pseis);
        $('#sinpseis').hide();
    }

    if (p === 'siete') {
        const psiete = JSON.parse(localStorage.EsperanzaPsiete);

        $('#lpsiete').addClass('fontTahu fa-2x text-info');
        $('#lpsiete').html(psiete);
        $('#sinpsiete').hide();
    }


    if (p === 'uno') {
        const puno = JSON.parse(localStorage.EsperanzaPuno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        console.log('aceptado = ' + p)
        const pcinco = JSON.parse(localStorage.EsperanzaPcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.EsperanzaPdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.EsperanzaPtres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.EsperanzaPcuatro);

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
