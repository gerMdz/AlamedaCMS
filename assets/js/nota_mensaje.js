import $ from 'jquery';
$(function () {
    const puno = localStorage.getItem("OrgulloPuno");
    const pdos = localStorage.getItem("OrgulloPdos");
    const ptres = localStorage.getItem("OrgulloPtres");
    const pcuatro = localStorage.getItem("OrgulloPcuatro");
    const pcinco = localStorage.getItem("OrgulloPcinco");
    const pseis = localStorage.getItem("OrgulloPseis");
    const psiete = localStorage.getItem("OrgulloPsiete");
    const pocho = localStorage.getItem("OrgulloPocho");
    const pnueve = localStorage.getItem("OrgulloPnueve");
    const pdiez = localStorage.getItem("OrgulloPdiez");

    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.OrgulloPcinco))
        muestra1('#lpcinco', '#sinpcinco')
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco')
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.OrgulloPuno))
        muestra1('#lpuno', '#sinpuno')
        aceptado('uno');
        console.log('19')
    } else {
        oculta1('#lpuno', '#sinpuno')
        console.log('21')
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.OrgulloPdos))
        muestra1('#lpdos', '#sinpdos')
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos')
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.OrgulloPtres))
        muestra1('#lptres', '#sinptres')
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres')
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.OrgulloPcuatro))
        muestra1('#lpcuatro', '#sinpcuatro')
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro')
    }

    if (pseis != null) {
        $('#pseis').val(JSON.parse(localStorage.OrgulloPseis))
        muestra1('#lpseis', '#sinpseis')
        aceptado('seis');
    } else {
        oculta1('#lpseis', '#sinpseis')
    }
    if (psiete != null) {
        $('#psiete').val(JSON.parse(localStorage.OrgulloPsiete))
        muestra1('#lpsiete', '#sinpsiete')
        aceptado('siete');
    } else {
        oculta1('#lpsiete', '#sinpsiete')
    }

    if (pocho != null) {
        $('#pocho').val(JSON.parse(localStorage.OrgulloPocho))
        muestra1('#lpocho', '#sinpocho')
        aceptado('ocho');
    } else {
        oculta1('#lpocho', '#sinpocho')
    }

    if (pnueve != null) {
        $('#pnueve').val(JSON.parse(localStorage.OrgulloPnueve))
        muestra1('#lpnueve', '#sinpnueve')
        aceptado('nueve');
    } else {
        oculta1('#lpnueve', '#sinpnueve')
    }

    if (pdiez != null) {
        $('#pdiez').val(JSON.parse(localStorage.OrgulloPdiez))
        muestra1('#lpdiez', '#sinpdiez')
        aceptado('diez');
    } else {
        oculta1('#lpdiez', '#sinpdiez')
    }

});

$(function () {
    $('#xpdiez').click(function () {
        const pdiez = $('#pdiez').val();
        if (pdiez == null || pdiez == '') {
            $('#pdiez').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diez')
        $('#xpdiez').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiez')) {
            console.log('diez visible')
            muestra1('#sinpdiez', '#lpdiez')
        } else {
            console.log('diez hidden')
            aceptado('diez')
            oculta1('#sinpdiez', '#lpdiez')
        }
    });

    $('#xpnueve').click(function () {
        const pnueve = $('#pnueve').val();
        if (pnueve == null || pnueve == '') {
            $('#pnueve').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('nueve')
        $('#xpnueve').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpnueve')) {
            console.log('ocho visible')
            muestra1('#sinpnueve', '#lpnueve')
        } else {
            console.log('nueve hidden')
            aceptado('nueve')
            oculta1('#sinpnueve', '#lpnueve')
        }
    });

    $('#xpocho').click(function () {
        const pocho = $('#pocho').val();
        if (pocho == null || pocho == '') {
            $('#pocho').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('ocho')
        $('#xpocho').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpocho')) {
            console.log('ocho visible')
            muestra1('#sinpocho', '#lpocho')
        } else {
            console.log('ocho hidden')
            aceptado('ocho')
            oculta1('#sinpocho', '#lpocho')
        }
    });

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
    if (p === 'diez') {
        const pdiez = $('#pdiez').val();
        localStorage.OrgulloPdiez = JSON.stringify(pdiez);
    }

    if (p === 'nueve') {
        const pnueve = $('#pnueve').val();
        localStorage.OrgulloPnueve = JSON.stringify(pnueve);
    }

    if (p === 'ocho') {
        const pocho = $('#pocho').val();
        localStorage.OrgulloPocho = JSON.stringify(pocho);
    }

    if (p === 'siete') {
        const psiete = $('#psiete').val();
        localStorage.OrgulloPsiete = JSON.stringify(psiete);
    }

    if (p === 'seis') {
        const pseis = $('#pseis').val();
        localStorage.OrgulloPseis = JSON.stringify(pseis);
    }

    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.OrgulloPcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.OrgulloPuno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.OrgulloPdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.OrgulloPtres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.OrgulloPcuatro = JSON.stringify(pcuatro);
    }

}

function aceptado(p) {

    console.log('aceptado' + p);

    if (p === 'diez') {
        const pdiez = JSON.parse(localStorage.OrgulloPdiez);

        $('#lpdiez').addClass('fontTahu fa-2x text-info');
        $('#lpdiez').html(pdiez);
        $('#sinpdiez').hide();
    }

    if (p === 'nueve') {
        const pnueve = JSON.parse(localStorage.OrgulloPnueve);

        $('#lpnueve').addClass('fontTahu fa-2x text-info');
        $('#lpnueve').html(pnueve);
        $('#sinpnueve').hide();
    }

    if (p === 'ocho') {
        const pocho = JSON.parse(localStorage.OrgulloPocho);

        $('#lpocho').addClass('fontTahu fa-2x text-info');
        $('#lpocho').html(pocho);
        $('#sinpocho').hide();
    }

    if (p === 'seis') {
        const pseis = JSON.parse(localStorage.OrgulloPseis);

        $('#lpseis').addClass('fontTahu fa-2x text-info');
        $('#lpseis').html(pseis);
        $('#sinpseis').hide();
    }

    if (p === 'siete') {
        const psiete = JSON.parse(localStorage.OrgulloPsiete);

        $('#lpsiete').addClass('fontTahu fa-2x text-info');
        $('#lpsiete').html(psiete);
        $('#sinpsiete').hide();
    }

    if (p === 'uno') {
        const puno = JSON.parse(localStorage.OrgulloPuno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        console.log('aceptado = ' + p)
        const pcinco = JSON.parse(localStorage.OrgulloPcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.OrgulloPdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.OrgulloPtres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.OrgulloPcuatro);

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
