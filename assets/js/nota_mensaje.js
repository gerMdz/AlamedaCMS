import $ from 'jquery';
$(function () {
    const puno = localStorage.getItem("lav01Puno");
    const pdos = localStorage.getItem("lav01Pdos");
    const ptres = localStorage.getItem("lav01Ptres");
    const pcuatro = localStorage.getItem("lav01Pcuatro");
    const pcinco = localStorage.getItem("lav01Pcinco");
    const pseis = localStorage.getItem("lav01Pseis");
    const psiete = localStorage.getItem("lav01Psiete");
    const pocho = localStorage.getItem("lav01Pocho");
    const pnueve = localStorage.getItem("lav01Pnueve");
    const pdiez = localStorage.getItem("lav01Pdiez");
    const ponce = localStorage.getItem("lav01Ponce");
    const pdoce = localStorage.getItem("lav01Pdoce");
    const ptrece = localStorage.getItem("lav01Ptrece");
    const pcatorce = localStorage.getItem("lav01Pcatorce");
    const pquince = localStorage.getItem("lav01Pquince");
    const pdieciseis = localStorage.getItem("lav01Pdieciseis");
    const pdiecisiete = localStorage.getItem("lav01Pdiecisiete");
    const pdieciocho = localStorage.getItem("lav01Pdieciocho");
    const pdiecinueve = localStorage.getItem("lav01Pdiecinueve");
    const pveinte = localStorage.getItem("lav01Pveinte");

    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.lav01Pcinco))
        muestra1('#lpcinco', '#sinpcinco')
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco')
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.lav01Puno))
        muestra1('#lpuno', '#sinpuno')
        aceptado('uno');
        console.log('19')
    } else {
        oculta1('#lpuno', '#sinpuno')
        console.log('21')
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.lav01Pdos))
        muestra1('#lpdos', '#sinpdos')
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos')
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.lav01Ptres))
        muestra1('#lptres', '#sinptres')
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres')
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.lav01Pcuatro))
        muestra1('#lpcuatro', '#sinpcuatro')
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro')
    }

    if (pseis != null) {
        $('#pseis').val(JSON.parse(localStorage.lav01Pseis))
        muestra1('#lpseis', '#sinpseis')
        aceptado('seis');
    } else {
        oculta1('#lpseis', '#sinpseis')
    }
    if (psiete != null) {
        $('#psiete').val(JSON.parse(localStorage.lav01Psiete))
        muestra1('#lpsiete', '#sinpsiete')
        aceptado('siete');
    } else {
        oculta1('#lpsiete', '#sinpsiete')
    }

    if (pocho != null) {
        $('#pocho').val(JSON.parse(localStorage.lav01Pocho))
        muestra1('#lpocho', '#sinpocho')
        aceptado('ocho');
    } else {
        oculta1('#lpocho', '#sinpocho')
    }

    if (pnueve != null) {
        $('#pnueve').val(JSON.parse(localStorage.lav01Pnueve))
        muestra1('#lpnueve', '#sinpnueve')
        aceptado('nueve');
    } else {
        oculta1('#lpnueve', '#sinpnueve')
    }

    if (pdiez != null) {
        $('#pdiez').val(JSON.parse(localStorage.lav01Pdiez))
        muestra1('#lpdiez', '#sinpdiez')
        aceptado('diez');
    } else {
        oculta1('#lpdiez', '#sinpdiez')
    }

    if (ponce != null) {
        $('#ponce').val(JSON.parse(localStorage.lav01Ponce))
        muestra1('#lponce', '#sinponce')
        aceptado('once');
    } else {
        oculta1('#lponce', '#sinponce')
    }
if (pdoce != null) {
        $('#pdoce').val(JSON.parse(localStorage.lav01Pdoce))
        muestra1('#lpdoce', '#sinpdoce')
        aceptado('doce');
    } else {
        oculta1('#lpdoce', '#sinpdoce')
    }
if (ptrece != null) {
        $('#ptrece').val(JSON.parse(localStorage.lav01Ptrece))
        muestra1('#lptrece', '#sinptrece')
        aceptado('trece');
    } else {
        oculta1('#lptrece', '#sinptrece')
    }
if (pcatorce != null) {
        $('#pcatorce').val(JSON.parse(localStorage.lav01Pcatorce))
        muestra1('#lpcatorce', '#sinpcatorce')
        aceptado('catorce');
    } else {
        oculta1('#lpcatorce', '#sinpcatorce')
    }
if (pquince != null) {
        $('#pquince').val(JSON.parse(localStorage.lav01Pquince))
        muestra1('#lpquince', '#sinpquince')
        aceptado('quince');
    } else {
        oculta1('#lpquince', '#sinpquince')
    }
if (pdieciseis != null) {
        $('#pdieciseis').val(JSON.parse(localStorage.lav01Pdieciseis))
        muestra1('#lpdieciseis', '#sinpdieciseis')
        aceptado('dieciseis');
    } else {
        oculta1('#lpdieciseis', '#sinpdieciseis')
    }
if (pdiecisiete != null) {
        $('#pdiecisiete').val(JSON.parse(localStorage.lav01Pdiecisiete))
        muestra1('#lpdiecisiete', '#sinpdiecisiete')
        aceptado('diecisiete');
    } else {
        oculta1('#lpdiecisiete', '#sinpdiecisiete')
    }
if (pdieciocho != null) {
        $('#pdieciocho').val(JSON.parse(localStorage.lav01Pdieciocho))
        muestra1('#lpdieciocho', '#sinpdieciocho')
        aceptado('dieciocho');
    } else {
        oculta1('#lpdieciocho', '#sinpdieciocho')
    }
if (pdiecinueve != null) {
        $('#pdiecinueve').val(JSON.parse(localStorage.lav01Pdiecinueve))
        muestra1('#lpdiecinueve', '#sinpdiecinueve')
        aceptado('diecinueve');
    } else {
        oculta1('#lpdiecinueve', '#sinpdiecinueve')
    }
if (pveinte != null) {
        $('#pveinte').val(JSON.parse(localStorage.lav01Pveinte))
        muestra1('#lpveinte', '#sinpveinte')
        aceptado('veinte');
    } else {
        oculta1('#lpveinte', '#sinpveinte')
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

    $('#xponce').click(function () {
        const ponce = $('#ponce').val();
        if (ponce == null || ponce == '') {
            $('#ponce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('once')
        $('#xponce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lponce')) {
            muestra1('#sinponce', '#lponce')
        } else {
            aceptado('once')
            oculta1('#sinponce', '#lponce')
        }
    });

    $('#xpdoce').click(function () {
        const pdoce = $('#pdoce').val();
        if (pdoce == null || pdoce == '') {
            $('#pdoce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('doce')
        $('#xpdoce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdoce')) {
            muestra1('#sinpdoce', '#lpdoce')
        } else {
            aceptado('doce')
            oculta1('#sinpdoce', '#lpdoce')
        }
    });

    $('#xptrece').click(function () {
        const ptrece = $('#ptrece').val();
        if (ptrece == null || ptrece == '') {
            $('#ptrece').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('trece')
        $('#xptrece').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lptrece')) {
            console.log('trece visible')
            muestra1('#sinptrece', '#lptrece')
        } else {
            console.log('trece hidden')
            aceptado('trece')
            oculta1('#sinptrece', '#lptrece')
        }
    });

    $('#xpcatorce').click(function () {
        const pcatorce = $('#pcatorce').val();
        if (pcatorce == null || pcatorce == '') {
            $('#pcatorce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('catorce')
        $('#xpcatorce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcatorce')) {
            console.log('catorce visible')
            muestra1('#sinpcatorce', '#lpcatorce')
        } else {
            console.log('catorce hidden')
            aceptado('catorce')
            oculta1('#sinpcatorce', '#lpcatorce')
        }
    });

    $('#xpquince').click(function () {
        const pquince = $('#pquince').val();
        if (pquince == null || pquince == '') {
            $('#pquince').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('quince')
        $('#xpquince').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpquince')) {
            console.log('quince visible')
            muestra1('#sinpquince', '#lpquince')
        } else {
            console.log('quince hidden')
            aceptado('quince')
            oculta1('#sinpquince', '#lpquince')
        }
    });

    $('#xpdieciseis').click(function () {
        const pdieciseis = $('#pdieciseis').val();
        if (pdieciseis == null || pdieciseis == '') {
            $('#pdieciseis').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('dieciseis')
        $('#xpdieciseis').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdieciseis')) {
            console.log('dieciseis visible')
            muestra1('#sinpdieciseis', '#lpdieciseis')
        } else {
            console.log('dieciseis hidden')
            aceptado('dieciseis')
            oculta1('#sinpdieciseis', '#lpdieciseis')
        }
    });

    $('#xpdiecisiete').click(function () {
        const pdiecisiete = $('#pdiecisiete').val();
        if (pdiecisiete == null || pdiecisiete == '') {
            $('#pdiecisiete').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diecisiete')
        $('#xpdiecisiete').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiecisiete')) {
            console.log('diecisiete visible')
            muestra1('#sinpdiecisiete', '#lpdiecisiete')
        } else {
            console.log('diecisiete hidden')
            aceptado('diecisiete')
            oculta1('#sinpdiecisiete', '#lpdiecisiete')
        }
    });

    $('#xpdieciocho').click(function () {
        const pdieciocho = $('#pdieciocho').val();
        if (pdieciocho == null || pdieciocho == '') {
            $('#pdieciocho').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('dieciocho')
        $('#xpdieciocho').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdieciocho')) {
            console.log('dieciocho visible')
            muestra1('#sinpdieciocho', '#lpdieciocho')
        } else {
            console.log('dieciocho hidden')
            aceptado('dieciocho')
            oculta1('#sinpdieciocho', '#lpdieciocho')
        }
    });
    $('#xpdiecinueve').click(function () {
        const pdiecinueve = $('#pdiecinueve').val();
        if (pdiecinueve == null || pdiecinueve == '') {
            $('#pdiecinueve').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diecinueve')
        $('#xpdiecinueve').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiecinueve')) {
            console.log('diecinueve visible')
            muestra1('#sinpdiecinueve', '#lpdiecinueve')
        } else {
            console.log('diecinueve hidden')
            aceptado('diecinueve')
            oculta1('#sinpdiecinueve', '#lpdiecinueve')
        }
    });
    $('#xpveinte').click(function () {
        const pveinte = $('#pveinte').val();
        if (pveinte == null || pveinte == '') {
            $('#pveinte').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('veinte')
        $('#xpveinte').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpveinte')) {
            console.log('veinte visible')
            muestra1('#sinpveinte', '#lpveinte')
        } else {
            console.log('veinte hidden')
            aceptado('veinte')
            oculta1('#sinpveinte', '#lpveinte')
        }
    });
});


function procesa(p) {
    console.log('p = ' + p)
    if (p === 'diez') {
        const pdiez = $('#pdiez').val();
        localStorage.lav01Pdiez = JSON.stringify(pdiez);
    }

    if (p === 'nueve') {
        const pnueve = $('#pnueve').val();
        localStorage.lav01Pnueve = JSON.stringify(pnueve);
    }

    if (p === 'ocho') {
        const pocho = $('#pocho').val();
        localStorage.lav01Pocho = JSON.stringify(pocho);
    }

    if (p === 'siete') {
        const psiete = $('#psiete').val();
        localStorage.lav01Psiete = JSON.stringify(psiete);
    }

    if (p === 'seis') {
        const pseis = $('#pseis').val();
        localStorage.lav01Pseis = JSON.stringify(pseis);
    }

    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.lav01Pcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.lav01Puno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.lav01Pdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.lav01Ptres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.lav01Pcuatro = JSON.stringify(pcuatro);
    }

    if (p === 'once') {
        const ponce = $('#ponce').val();
        localStorage.lav01Ponce = JSON.stringify(ponce);
    }
    
    if (p === 'doce') {
        const pdoce = $('#pdoce').val();
        localStorage.lav01Pdoce = JSON.stringify(pdoce);
    }
    if (p === 'trece') {
        const ptrece = $('#ptrece').val();
        localStorage.lav01Ptrece = JSON.stringify(ptrece);
    }
    if (p === 'catorce') {
        const pcatorce = $('#pcatorce').val();
        localStorage.lav01Pcatorce = JSON.stringify(pcatorce);
    }
    if (p === 'quince') {
        const pquince = $('#pquince').val();
        localStorage.lav01Pquince = JSON.stringify(pquince);
    }
    if (p === 'dieciseis') {
        const pdieciseis = $('#pdieciseis').val();
        localStorage.lav01Pdieciseis = JSON.stringify(pdieciseis);
    }
    if (p === 'diecisiete') {
        const pdiecisiete = $('#pdiecisiete').val();
        localStorage.lav01Pdiecisiete = JSON.stringify(pdiecisiete);
    }
    if (p === 'dieciocho') {
        const pdieciocho = $('#pdieciocho').val();
        localStorage.lav01Pdieciocho = JSON.stringify(pdieciocho);
    }
    if (p === 'diecinueve') {
        const pdiecinueve = $('#pdiecinueve').val();
        localStorage.lav01Pdiecinueve = JSON.stringify(pdiecinueve);
    }
    if (p === 'veinte') {
        const pveinte = $('#pveinte').val();
        localStorage.lav01Pveinte = JSON.stringify(pveinte);
    }


}

function aceptado(p) {

    if (p === 'diez') {
        const pdiez = JSON.parse(localStorage.lav01Pdiez);

        $('#lpdiez').addClass('fontTahu fa-2x text-info');
        $('#lpdiez').html(pdiez);
        $('#sinpdiez').hide();
    }

    if (p === 'nueve') {
        const pnueve = JSON.parse(localStorage.lav01Pnueve);

        $('#lpnueve').addClass('fontTahu fa-2x text-info');
        $('#lpnueve').html(pnueve);
        $('#sinpnueve').hide();
    }

    if (p === 'ocho') {
        const pocho = JSON.parse(localStorage.lav01Pocho);

        $('#lpocho').addClass('fontTahu fa-2x text-info');
        $('#lpocho').html(pocho);
        $('#sinpocho').hide();
    }

    if (p === 'seis') {
        const pseis = JSON.parse(localStorage.lav01Pseis);

        $('#lpseis').addClass('fontTahu fa-2x text-info');
        $('#lpseis').html(pseis);
        $('#sinpseis').hide();
    }

    if (p === 'siete') {
        const psiete = JSON.parse(localStorage.lav01Psiete);

        $('#lpsiete').addClass('fontTahu fa-2x text-info');
        $('#lpsiete').html(psiete);
        $('#sinpsiete').hide();
    }

    if (p === 'uno') {
        const puno = JSON.parse(localStorage.lav01Puno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        console.log('aceptado = ' + p)
        const pcinco = JSON.parse(localStorage.lav01Pcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.lav01Pdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.lav01Ptres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.lav01Pcuatro);

        $('#lpcuatro').addClass('fontTahu fa-2x text-info');
        $('#lpcuatro').html(pcuatro);
        $('#sinpcuatro').hide();
    }

    if (p === 'once') {
        const ponce = JSON.parse(localStorage.lav01Ponce);

        $('#lponce').addClass('fontTahu fa-2x text-info');
        $('#lponce').html(ponce);
        $('#sinponce').hide();
    }

    if (p === 'doce') {
        const pdoce = JSON.parse(localStorage.lav01Pdoce);

        $('#lpdoce').addClass('fontTahu fa-2x text-info');
        $('#lpdoce').html(pdoce);
        $('#sinpdoce').hide();
    }

    if (p === 'trece') {
        const ptrece = JSON.parse(localStorage.lav01Ptrece);

        $('#lptrece').addClass('fontTahu fa-2x text-info');
        $('#lptrece').html(ptrece);
        $('#sinptrece').hide();
    }

    if (p === 'catorce') {
        const pcatorce = JSON.parse(localStorage.lav01Pcatorce);

        $('#lpcatorce').addClass('fontTahu fa-2x text-info');
        $('#lpcatorce').html(pcatorce);
        $('#sinpcatorce').hide();
    }
    if (p === 'quince') {
        const pquince = JSON.parse(localStorage.lav01Pquince);

        $('#lpquince').addClass('fontTahu fa-2x text-info');
        $('#lpquince').html(pquince);
        $('#sinpquince').hide();
    }
    if (p === 'dieciseis') {
        const pdieciseis = JSON.parse(localStorage.lav01Pdieciseis);

        $('#lpdieciseis').addClass('fontTahu fa-2x text-info');
        $('#lpdieciseis').html(pdieciseis);
        $('#sinpdieciseis').hide();
    }
    if (p === 'diecisiete') {
        const pdiecisiete = JSON.parse(localStorage.lav01Pdiecisiete);

        $('#lpdiecisiete').addClass('fontTahu fa-2x text-info');
        $('#lpdiecisiete').html(pdiecisiete);
        $('#sinpdiecisiete').hide();
    }
    if (p === 'dieciocho') {
        const pdieciocho = JSON.parse(localStorage.lav01Pdieciocho);

        $('#lpdieciocho').addClass('fontTahu fa-2x text-info');
        $('#lpdieciocho').html(pdieciocho);
        $('#sinpdieciocho').hide();
    }
    if (p === 'diecinueve') {
        const pdiecinueve = JSON.parse(localStorage.lav01Pdiecinueve);

        $('#lpdiecinueve').addClass('fontTahu fa-2x text-info');
        $('#lpdiecinueve').html(pdiecinueve);
        $('#sinpdiecinueve').hide();
    }
    if (p === 'veinte') {
        const pveinte = JSON.parse(localStorage.lav01Pveinte);

        $('#lpveinte').addClass('fontTahu fa-2x text-info');
        $('#lpveinte').html(pveinte);
        $('#sinpveinte').hide();
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

function muestra1(elementO2, elemento2) {
    $(elementO2).show()
    $(elemento2).hide()
}

function oculta1(elementO2, elemento2) {
    $(elementO2).hide()
    $(elemento2).show()
}
