import $ from 'jquery';

$(function () {
    const puno = localStorage.getItem("ra02Puno");
    const pdos = localStorage.getItem("ra02Pdos");
    const ptres = localStorage.getItem("ra02Ptres");
    const pcuatro = localStorage.getItem("ra02Pcuatro");
    const pcinco = localStorage.getItem("ra02Pcinco");
    const pseis = localStorage.getItem("ra02Pseis");
    const psiete = localStorage.getItem("ra02Psiete");
    const pocho = localStorage.getItem("ra02Pocho");
    const pnueve = localStorage.getItem("ra02Pnueve");
    const pdiez = localStorage.getItem("ra02Pdiez");
    const ponce = localStorage.getItem("ra02Ponce");
    const pdoce = localStorage.getItem("ra02Pdoce");
    const ptrece = localStorage.getItem("ra02Ptrece");
    const pcatorce = localStorage.getItem("ra02Pcatorce");
    const pquince = localStorage.getItem("ra02Pquince");
    const pdieciseis = localStorage.getItem("ra02Pdieciseis");
    const pdiecisiete = localStorage.getItem("ra02Pdiecisiete");
    const pdieciocho = localStorage.getItem("ra02Pdieciocho");
    const pdiecinueve = localStorage.getItem("ra02Pdiecinueve");
    const pveinte = localStorage.getItem("ra02Pveinte");
    const pveintiuno = localStorage.getItem("ra02Pveintiuno");

    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.ra02Pcinco));
        muestra1('#lpcinco', '#sinpcinco');
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco');
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.ra02Puno));
        muestra1('#lpuno', '#sinpuno');
        aceptado('uno');
    } else {
        oculta1('#lpuno', '#sinpuno');
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.ra02Pdos));
        muestra1('#lpdos', '#sinpdos');
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos');
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.ra02Ptres));
        muestra1('#lptres', '#sinptres');
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres');
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.ra02Pcuatro));
        muestra1('#lpcuatro', '#sinpcuatro');
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro');
    }

    if (pseis != null) {
        $('#pseis').val(JSON.parse(localStorage.ra02Pseis));
        muestra1('#lpseis', '#sinpseis');
        aceptado('seis');
    } else {
        oculta1('#lpseis', '#sinpseis');
    }
    if (psiete != null) {
        $('#psiete').val(JSON.parse(localStorage.ra02Psiete));
        muestra1('#lpsiete', '#sinpsiete');
        aceptado('siete');
    } else {
        oculta1('#lpsiete', '#sinpsiete');
    }

    if (pocho != null) {
        $('#pocho').val(JSON.parse(localStorage.ra02Pocho));
        muestra1('#lpocho', '#sinpocho');
        aceptado('ocho');
    } else {
        oculta1('#lpocho', '#sinpocho');
    }

    if (pnueve != null) {
        $('#pnueve').val(JSON.parse(localStorage.ra02Pnueve));
        muestra1('#lpnueve', '#sinpnueve');
        aceptado('nueve');
    } else {
        oculta1('#lpnueve', '#sinpnueve');
    }

    if (pdiez != null) {
        $('#pdiez').val(JSON.parse(localStorage.ra02Pdiez));
        muestra1('#lpdiez', '#sinpdiez');
        aceptado('diez');
    } else {
        oculta1('#lpdiez', '#sinpdiez');
    }

    if (ponce != null) {
        $('#ponce').val(JSON.parse(localStorage.ra02Ponce));
        muestra1('#lponce', '#sinponce');
        aceptado('once');
    } else {
        oculta1('#lponce', '#sinponce');
    }
    if (pdoce != null) {
        $('#pdoce').val(JSON.parse(localStorage.ra02Pdoce));
        muestra1('#lpdoce', '#sinpdoce');
        aceptado('doce');
    } else {
        oculta1('#lpdoce', '#sinpdoce');
    }
    if (ptrece != null) {
        $('#ptrece').val(JSON.parse(localStorage.ra02Ptrece));
        muestra1('#lptrece', '#sinptrece');
        aceptado('trece');
    } else {
        oculta1('#lptrece', '#sinptrece');
    }
    if (pcatorce != null) {
        $('#pcatorce').val(JSON.parse(localStorage.ra02Pcatorce));
        muestra1('#lpcatorce', '#sinpcatorce');
        aceptado('catorce');
    } else {
        oculta1('#lpcatorce', '#sinpcatorce');
    }
    if (pquince != null) {
        $('#pquince').val(JSON.parse(localStorage.ra02Pquince));
        muestra1('#lpquince', '#sinpquince');
        aceptado('quince');
    } else {
        oculta1('#lpquince', '#sinpquince');
    }
    if (pdieciseis != null) {
        $('#pdieciseis').val(JSON.parse(localStorage.ra02Pdieciseis));
        muestra1('#lpdieciseis', '#sinpdieciseis');
        aceptado('dieciseis');
    } else {
        oculta1('#lpdieciseis', '#sinpdieciseis');
    }
    if (pdiecisiete != null) {
        $('#pdiecisiete').val(JSON.parse(localStorage.ra02Pdiecisiete));
        muestra1('#lpdiecisiete', '#sinpdiecisiete');
        aceptado('diecisiete');
    } else {
        oculta1('#lpdiecisiete', '#sinpdiecisiete');
    }
    if (pdieciocho != null) {
        $('#pdieciocho').val(JSON.parse(localStorage.ra02Pdieciocho));
        muestra1('#lpdieciocho', '#sinpdieciocho');
        aceptado('dieciocho');
    } else {
        oculta1('#lpdieciocho', '#sinpdieciocho');
    }
    if (pdiecinueve != null) {
        $('#pdiecinueve').val(JSON.parse(localStorage.ra02Pdiecinueve));
        muestra1('#lpdiecinueve', '#sinpdiecinueve');
        aceptado('diecinueve');
    } else {
        oculta1('#lpdiecinueve', '#sinpdiecinueve');
    }
    if (pveinte != null) {
        $('#pveinte').val(JSON.parse(localStorage.ra02Pveinte));
        muestra1('#lpveinte', '#sinpveinte');
        aceptado('veinte');
    } else {
        oculta1('#lpveinte', '#sinpveinte');
    }
    if (pveintiuno != null) {
        $('#pveintiuno').val(JSON.parse(localStorage.ra02Pveintiuno));
        muestra1('#lpveintiuno', '#sinpveintiuno');
        aceptado('veintiuno');
    } else {
        oculta1('#lpveintiuno', '#sinpveintiuno');
    }

});

$(function () {
    $('#xpdiez').click(function () {
        const pdiez = $('#pdiez').val();
        if (pdiez == null || pdiez == '') {
            $('#pdiez').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diez');
        $('#xpdiez').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiez')) {
            muestra1('#sinpdiez', '#lpdiez');
        } else {
            aceptado('diez');
            oculta1('#sinpdiez', '#lpdiez');
        }
    });

    $('#xpnueve').click(function () {
        const pnueve = $('#pnueve').val();
        if (pnueve == null || pnueve == '') {
            $('#pnueve').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('nueve');
        $('#xpnueve').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpnueve')) {
            muestra1('#sinpnueve', '#lpnueve');
        } else {
            aceptado('nueve');
            oculta1('#sinpnueve', '#lpnueve');
        }
    });

    $('#xpocho').click(function () {
        const pocho = $('#pocho').val();
        if (pocho == null || pocho == '') {
            $('#pocho').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('ocho');
        $('#xpocho').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpocho')) {
            muestra1('#sinpocho', '#lpocho');
        } else {
            aceptado('ocho');
            oculta1('#sinpocho', '#lpocho');
        }
    });

    $('#xpsiete').click(function () {
        const psiete = $('#psiete').val();
        if (psiete == null || psiete == '') {
            $('#psiete').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('siete');
        $('#xpsiete').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpsiete')) {
            muestra1('#sinpsiete', '#lpsiete');
        } else {
            aceptado('siete');
            oculta1('#sinpsiete', '#lpsiete');
        }
    });

    $('#xpseis').click(function () {
        const pseis = $('#pseis').val();
        if (pseis == null || pseis == '') {
            $('#pseis').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('seis');
        $('#xpseis').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpseis')) {
            muestra1('#sinpseis', '#lpseis');
        } else {
            aceptado('seis');
            oculta1('#sinpseis', '#lpseis');
        }
    });

    $('#xpcinco').click(function () {
        const pcinco = $('#pcinco').val();
        if (pcinco == null || pcinco == '') {
            $('#pcinco').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('cinco');
        $('#xpcinco').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcinco')) {
            muestra1('#sinpcinco', '#lpcinco');
        } else {
            aceptado('cinco');
            oculta1('#sinpcinco', '#lpcinco');
        }
    });

    $('#xpuno').click(function () {

        const puno = $('#puno').val();

        if (puno == null || puno == '') {
            $('#puno').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('uno');
        $('#xpuno').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpuno')) {
            muestra1('#sinpuno', '#lpuno');
        } else {
            aceptado('uno');
            oculta1('#sinpuno', '#lpuno');
        }
    });

    $('#xpdos').click(function () {
        const pdos = $('#pdos').val();
        if (pdos == null || pdos == '') {
            $('#pdos').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('dos');
        $('#xpdos').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdos')) {
            muestra1('#sinpdos', '#lpdos');
        } else {
            aceptado('dos');
            oculta1('#sinpdos', '#lpdos');
        }
    });

    $('#xptres').click(function () {
        const ptres = $('#ptres').val();
        if (ptres == null || ptres == '') {
            $('#ptres').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('tres');
        $('#xptres').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lptres')) {
            muestra1('#sinptres', '#lptres');
        } else {
            aceptado('tres');
            oculta1('#sinptres', '#lptres');
        }
    });

    $('#xpcuatro').click(function () {
        const pcuatro = $('#pcuatro').val();
        if (pcuatro == null || pcuatro == '') {
            $('#pcuatro').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('cuatro');
        $('#xpcuatro').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcuatro')) {
            muestra1('#sinpcuatro', '#lpcuatro');
        } else {
            aceptado('cuatro');
            oculta1('#sinpcuatro', '#lpcuatro');
        }
    });

    $('#xponce').click(function () {
        const ponce = $('#ponce').val();
        if (ponce == null || ponce == '') {
            $('#ponce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('once');
        $('#xponce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lponce')) {
            muestra1('#sinponce', '#lponce');
        } else {
            aceptado('once');
            oculta1('#sinponce', '#lponce');
        }
    });

    $('#xpdoce').click(function () {
        const pdoce = $('#pdoce').val();
        if (pdoce == null || pdoce == '') {
            $('#pdoce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('doce');
        $('#xpdoce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdoce')) {
            muestra1('#sinpdoce', '#lpdoce');
        } else {
            aceptado('doce');
            oculta1('#sinpdoce', '#lpdoce');
        }
    });

    $('#xptrece').click(function () {
        const ptrece = $('#ptrece').val();
        if (ptrece == null || ptrece == '') {
            $('#ptrece').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('trece');
        $('#xptrece').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lptrece')) {

            muestra1('#sinptrece', '#lptrece');
        } else {

            aceptado('trece');
            oculta1('#sinptrece', '#lptrece');
        }
    });

    $('#xpcatorce').click(function () {
        const pcatorce = $('#pcatorce').val();
        if (pcatorce == null || pcatorce == '') {
            $('#pcatorce').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('catorce');
        $('#xpcatorce').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpcatorce')) {
            muestra1('#sinpcatorce', '#lpcatorce');
        } else {
            aceptado('catorce');
            oculta1('#sinpcatorce', '#lpcatorce');
        }
    });

    $('#xpquince').click(function () {
        const pquince = $('#pquince').val();
        if (pquince == null || pquince == '') {
            $('#pquince').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('quince');
        $('#xpquince').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpquince')) {
            muestra1('#sinpquince', '#lpquince');
        } else {
            aceptado('quince');
            oculta1('#sinpquince', '#lpquince');
        }
    });

    $('#xpdieciseis').click(function () {
        const pdieciseis = $('#pdieciseis').val();
        if (pdieciseis == null || pdieciseis == '') {
            $('#pdieciseis').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('dieciseis');
        $('#xpdieciseis').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdieciseis')) {
            muestra1('#sinpdieciseis', '#lpdieciseis');
        } else {
            aceptado('dieciseis');
            oculta1('#sinpdieciseis', '#lpdieciseis');
        }
    });

    $('#xpdiecisiete').click(function () {
        const pdiecisiete = $('#pdiecisiete').val();
        if (pdiecisiete == null || pdiecisiete == '') {
            $('#pdiecisiete').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diecisiete');
        $('#xpdiecisiete').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiecisiete')) {
            muestra1('#sinpdiecisiete', '#lpdiecisiete');
        } else {
            aceptado('diecisiete');
            oculta1('#sinpdiecisiete', '#lpdiecisiete');
        }
    });

    $('#xpdieciocho').click(function () {
        const pdieciocho = $('#pdieciocho').val();
        if (pdieciocho == null || pdieciocho == '') {
            $('#pdieciocho').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('dieciocho');
        $('#xpdieciocho').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdieciocho')) {
            muestra1('#sinpdieciocho', '#lpdieciocho');
        } else {
            aceptado('dieciocho');
            oculta1('#sinpdieciocho', '#lpdieciocho');
        }
    });
    $('#xpdiecinueve').click(function () {
        const pdiecinueve = $('#pdiecinueve').val();
        if (pdiecinueve == null || pdiecinueve == '') {
            $('#pdiecinueve').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('diecinueve');
        $('#xpdiecinueve').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpdiecinueve')) {
            muestra1('#sinpdiecinueve', '#lpdiecinueve');
        } else {
            aceptado('diecinueve');
            oculta1('#sinpdiecinueve', '#lpdiecinueve');
        }
    });
    $('#xpveinte').click(function () {
        const pveinte = $('#pveinte').val();
        if (pveinte == null || pveinte == '') {
            $('#pveinte').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('veinte');
        $('#xpveinte').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpveinte')) {
            muestra1('#sinpveinte', '#lpveinte');
        } else {
            aceptado('veinte');
            oculta1('#sinpveinte', '#lpveinte');
        }
    });
    
    $('#xpveintiuno').click(function () {
        const pveintiuno = $('#pveintiuno').val();
        if (pveintiuno == null || pveintiuno == '') {
            $('#pveintiuno').attr('placeholder', 'Aquí debés completar la idea');
            return false;
        }
        procesa('veintiuno');
        $('#xpveintiuno').toggleClass('fa fa-star-o').toggleClass('fa fa-start');
        if (esVisible('#lpveintiuno')) {
            muestra1('#sinpveintiuno', '#lpveintiuno');
        } else {
            aceptado('veintiuno');
            oculta1('#sinpveintiuno', '#lpveintiuno');
        }
    });
});


function procesa(p) {
    if (p === 'diez') {
        const pdiez = $('#pdiez').val();
        localStorage.ra02Pdiez = JSON.stringify(pdiez);
    }

    if (p === 'nueve') {
        const pnueve = $('#pnueve').val();
        localStorage.ra02Pnueve = JSON.stringify(pnueve);
    }

    if (p === 'ocho') {
        const pocho = $('#pocho').val();
        localStorage.ra02Pocho = JSON.stringify(pocho);
    }

    if (p === 'siete') {
        const psiete = $('#psiete').val();
        localStorage.ra02Psiete = JSON.stringify(psiete);
    }

    if (p === 'seis') {
        const pseis = $('#pseis').val();
        localStorage.ra02Pseis = JSON.stringify(pseis);
    }

    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.ra02Pcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.ra02Puno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.ra02Pdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.ra02Ptres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.ra02Pcuatro = JSON.stringify(pcuatro);
    }

    if (p === 'once') {
        const ponce = $('#ponce').val();
        localStorage.ra02Ponce = JSON.stringify(ponce);
    }

    if (p === 'doce') {
        const pdoce = $('#pdoce').val();
        localStorage.ra02Pdoce = JSON.stringify(pdoce);
    }
    if (p === 'trece') {
        const ptrece = $('#ptrece').val();
        localStorage.ra02Ptrece = JSON.stringify(ptrece);
    }
    if (p === 'catorce') {
        const pcatorce = $('#pcatorce').val();
        localStorage.ra02Pcatorce = JSON.stringify(pcatorce);
    }
    if (p === 'quince') {
        const pquince = $('#pquince').val();
        localStorage.ra02Pquince = JSON.stringify(pquince);
    }
    if (p === 'dieciseis') {
        const pdieciseis = $('#pdieciseis').val();
        localStorage.ra02Pdieciseis = JSON.stringify(pdieciseis);
    }
    if (p === 'diecisiete') {
        const pdiecisiete = $('#pdiecisiete').val();
        localStorage.ra02Pdiecisiete = JSON.stringify(pdiecisiete);
    }
    if (p === 'dieciocho') {
        const pdieciocho = $('#pdieciocho').val();
        localStorage.ra02Pdieciocho = JSON.stringify(pdieciocho);
    }
    if (p === 'diecinueve') {
        const pdiecinueve = $('#pdiecinueve').val();
        localStorage.ra02Pdiecinueve = JSON.stringify(pdiecinueve);
    }
    if (p === 'veinte') {
        const pveinte = $('#pveinte').val();
        localStorage.ra02Pveinte = JSON.stringify(pveinte);
    }
    if (p === 'veintiuno') {
        const pveintiuno = $('#pveintiuno').val();
        localStorage.ra02Pveintiuno = JSON.stringify(pveintiuno);
    }

}

function aceptado(p) {

    if (p === 'diez') {
        const pdiez = JSON.parse(localStorage.ra02Pdiez);

        $('#lpdiez').addClass('fontTahu fa-2x text-info');
        $('#lpdiez').html(pdiez);
        $('#sinpdiez').hide();
    }

    if (p === 'nueve') {
        const pnueve = JSON.parse(localStorage.ra02Pnueve);

        $('#lpnueve').addClass('fontTahu fa-2x text-info');
        $('#lpnueve').html(pnueve);
        $('#sinpnueve').hide();
    }

    if (p === 'ocho') {
        const pocho = JSON.parse(localStorage.ra02Pocho);

        $('#lpocho').addClass('fontTahu fa-2x text-info');
        $('#lpocho').html(pocho);
        $('#sinpocho').hide();
    }

    if (p === 'seis') {
        const pseis = JSON.parse(localStorage.ra02Pseis);

        $('#lpseis').addClass('fontTahu fa-2x text-info');
        $('#lpseis').html(pseis);
        $('#sinpseis').hide();
    }

    if (p === 'siete') {
        const psiete = JSON.parse(localStorage.ra02Psiete);

        $('#lpsiete').addClass('fontTahu fa-2x text-info');
        $('#lpsiete').html(psiete);
        $('#sinpsiete').hide();
    }

    if (p === 'uno') {
        const puno = JSON.parse(localStorage.ra02Puno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        const pcinco = JSON.parse(localStorage.ra02Pcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.ra02Pdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.ra02Ptres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.ra02Pcuatro);

        $('#lpcuatro').addClass('fontTahu fa-2x text-info');
        $('#lpcuatro').html(pcuatro);
        $('#sinpcuatro').hide();
    }

    if (p === 'once') {
        const ponce = JSON.parse(localStorage.ra02Ponce);

        $('#lponce').addClass('fontTahu fa-2x text-info');
        $('#lponce').html(ponce);
        $('#sinponce').hide();
    }

    if (p === 'doce') {
        const pdoce = JSON.parse(localStorage.ra02Pdoce);

        $('#lpdoce').addClass('fontTahu fa-2x text-info');
        $('#lpdoce').html(pdoce);
        $('#sinpdoce').hide();
    }

    if (p === 'trece') {
        const ptrece = JSON.parse(localStorage.ra02Ptrece);

        $('#lptrece').addClass('fontTahu fa-2x text-info');
        $('#lptrece').html(ptrece);
        $('#sinptrece').hide();
    }

    if (p === 'catorce') {
        const pcatorce = JSON.parse(localStorage.ra02Pcatorce);

        $('#lpcatorce').addClass('fontTahu fa-2x text-info');
        $('#lpcatorce').html(pcatorce);
        $('#sinpcatorce').hide();
    }
    if (p === 'quince') {
        const pquince = JSON.parse(localStorage.ra02Pquince);

        $('#lpquince').addClass('fontTahu fa-2x text-info');
        $('#lpquince').html(pquince);
        $('#sinpquince').hide();
    }
    if (p === 'dieciseis') {
        const pdieciseis = JSON.parse(localStorage.ra02Pdieciseis);

        $('#lpdieciseis').addClass('fontTahu fa-2x text-info');
        $('#lpdieciseis').html(pdieciseis);
        $('#sinpdieciseis').hide();
    }
    if (p === 'diecisiete') {
        const pdiecisiete = JSON.parse(localStorage.ra02Pdiecisiete);

        $('#lpdiecisiete').addClass('fontTahu fa-2x text-info');
        $('#lpdiecisiete').html(pdiecisiete);
        $('#sinpdiecisiete').hide();
    }
    if (p === 'dieciocho') {
        const pdieciocho = JSON.parse(localStorage.ra02Pdieciocho);

        $('#lpdieciocho').addClass('fontTahu fa-2x text-info');
        $('#lpdieciocho').html(pdieciocho);
        $('#sinpdieciocho').hide();
    }
    if (p === 'diecinueve') {
        const pdiecinueve = JSON.parse(localStorage.ra02Pdiecinueve);

        $('#lpdiecinueve').addClass('fontTahu fa-2x text-info');
        $('#lpdiecinueve').html(pdiecinueve);
        $('#sinpdiecinueve').hide();
    }
    if (p === 'veinte') {
        const pveinte = JSON.parse(localStorage.ra02Pveinte);

        $('#lpveinte').addClass('fontTahu fa-2x text-info');
        $('#lpveinte').html(pveinte);
        $('#sinpveinte').hide();
    }
    if (p === 'veintiuno') {
        const pveintiuno = JSON.parse(localStorage.ra02Pveintiuno);

        $('#lpveintiuno').addClass('fontTahu fa-2x text-info');
        $('#lpveintiuno').html(pveintiuno);
        $('#sinpveintiuno').hide();
    }

}

/**
 * Comprueba si un elemento es visible o no
 *
 * @param elemento
 */

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
