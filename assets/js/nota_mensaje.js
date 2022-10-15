import $ from 'jquery';
$(function () {
    const puno = localStorage.getItem("Qqslles3Puno");
    const pdos = localStorage.getItem("Qqslles3Pdos");
    const ptres = localStorage.getItem("Qqslles3Ptres");
    const pcuatro = localStorage.getItem("Qqslles3Pcuatro");
    const pcinco = localStorage.getItem("Qqslles3Pcinco");
    const pseis = localStorage.getItem("Qqslles3Pseis");
    const psiete = localStorage.getItem("Qqslles3Psiete");
    const pocho = localStorage.getItem("Qqslles3Pocho");
    const pnueve = localStorage.getItem("Qqslles3Pnueve");
    const pdiez = localStorage.getItem("Qqslles3Pdiez");
    const ponce = localStorage.getItem("Qqslles3Ponce");
    const pdoce = localStorage.getItem("Qqslles3Pdoce");
    const ptrece = localStorage.getItem("Qqslles3Ptrece");
    const pcatorce = localStorage.getItem("Qqslles3Pcatorce");
    const pquince = localStorage.getItem("Qqslles3Pquince");
    const pdieciseis = localStorage.getItem("Qqslles3Pdieciseis");
    const pdiecisiete = localStorage.getItem("Qqslles3Pdiecisiete");
    const pdieciocho = localStorage.getItem("Qqslles3Pdieciocho");
    const pdiecinueve = localStorage.getItem("Qqslles3Pdiecinueve");
    const pveinte = localStorage.getItem("Qqslles3Pveinte");

    if (pcinco != null) {
        $('#pcinco').val(JSON.parse(localStorage.Qqslles3Pcinco))
        muestra1('#lpcinco', '#sinpcinco')
        aceptado('cinco');
    } else {
        oculta1('#lpcinco', '#sinpcinco')
    }

    if (puno != null) {
        $('#puno').val(JSON.parse(localStorage.Qqslles3Puno))
        muestra1('#lpuno', '#sinpuno')
        aceptado('uno');
        console.log('19')
    } else {
        oculta1('#lpuno', '#sinpuno')
        console.log('21')
    }

    if (pdos != null) {
        $('#pdos').val(JSON.parse(localStorage.Qqslles3Pdos))
        muestra1('#lpdos', '#sinpdos')
        aceptado('dos');
    } else {
        oculta1('#lpdos', '#sinpdos')
    }

    if (ptres != null) {
        $('#ptres').val(JSON.parse(localStorage.Qqslles3Ptres))
        muestra1('#lptres', '#sinptres')
        aceptado('tres');
    } else {
        oculta1('#lptres', '#sinptres')
    }

    if (pcuatro != null) {
        $('#pcuatro').val(JSON.parse(localStorage.Qqslles3Pcuatro))
        muestra1('#lpcuatro', '#sinpcuatro')
        aceptado('cuatro');
    } else {
        oculta1('#lpcuatro', '#sinpcuatro')
    }

    if (pseis != null) {
        $('#pseis').val(JSON.parse(localStorage.Qqslles3Pseis))
        muestra1('#lpseis', '#sinpseis')
        aceptado('seis');
    } else {
        oculta1('#lpseis', '#sinpseis')
    }
    if (psiete != null) {
        $('#psiete').val(JSON.parse(localStorage.Qqslles3Psiete))
        muestra1('#lpsiete', '#sinpsiete')
        aceptado('siete');
    } else {
        oculta1('#lpsiete', '#sinpsiete')
    }

    if (pocho != null) {
        $('#pocho').val(JSON.parse(localStorage.Qqslles3Pocho))
        muestra1('#lpocho', '#sinpocho')
        aceptado('ocho');
    } else {
        oculta1('#lpocho', '#sinpocho')
    }

    if (pnueve != null) {
        $('#pnueve').val(JSON.parse(localStorage.Qqslles3Pnueve))
        muestra1('#lpnueve', '#sinpnueve')
        aceptado('nueve');
    } else {
        oculta1('#lpnueve', '#sinpnueve')
    }

    if (pdiez != null) {
        $('#pdiez').val(JSON.parse(localStorage.Qqslles3Pdiez))
        muestra1('#lpdiez', '#sinpdiez')
        aceptado('diez');
    } else {
        oculta1('#lpdiez', '#sinpdiez')
    }

    if (ponce != null) {
        $('#ponce').val(JSON.parse(localStorage.Qqslles3Ponce))
        muestra1('#lponce', '#sinponce')
        aceptado('once');
    } else {
        oculta1('#lponce', '#sinponce')
    }
if (pdoce != null) {
        $('#pdoce').val(JSON.parse(localStorage.Qqslles3Pdoce))
        muestra1('#lpdoce', '#sinpdoce')
        aceptado('doce');
    } else {
        oculta1('#lpdoce', '#sinpdoce')
    }
if (ptrece != null) {
        $('#ptrece').val(JSON.parse(localStorage.Qqslles3Ptrece))
        muestra1('#lptrece', '#sinptrece')
        aceptado('trece');
    } else {
        oculta1('#lptrece', '#sinptrece')
    }
if (pcatorce != null) {
        $('#pcatorce').val(JSON.parse(localStorage.Qqslles3Pcatorce))
        muestra1('#lpcatorce', '#sinpcatorce')
        aceptado('catorce');
    } else {
        oculta1('#lpcatorce', '#sinpcatorce')
    }
if (pquince != null) {
        $('#pquince').val(JSON.parse(localStorage.Qqslles3Pquince))
        muestra1('#lpquince', '#sinpquince')
        aceptado('quince');
    } else {
        oculta1('#lpquince', '#sinpquince')
    }
if (pdieciseis != null) {
        $('#pdieciseis').val(JSON.parse(localStorage.Qqslles3Pdieciseis))
        muestra1('#lpdieciseis', '#sinpdieciseis')
        aceptado('dieciseis');
    } else {
        oculta1('#lpdieciseis', '#sinpdieciseis')
    }
if (pdiecisiete != null) {
        $('#pdiecisiete').val(JSON.parse(localStorage.Qqslles3Pdiecisiete))
        muestra1('#lpdiecisiete', '#sinpdiecisiete')
        aceptado('diecisiete');
    } else {
        oculta1('#lpdiecisiete', '#sinpdiecisiete')
    }
if (pdieciocho != null) {
        $('#pdieciocho').val(JSON.parse(localStorage.Qqslles3Pdieciocho))
        muestra1('#lpdieciocho', '#sinpdieciocho')
        aceptado('dieciocho');
    } else {
        oculta1('#lpdieciocho', '#sinpdieciocho')
    }
if (pdiecinueve != null) {
        $('#pdiecinueve').val(JSON.parse(localStorage.Qqslles3Pdiecinueve))
        muestra1('#lpdiecinueve', '#sinpdiecinueve')
        aceptado('diecinueve');
    } else {
        oculta1('#lpdiecinueve', '#sinpdiecinueve')
    }
if (pveinte != null) {
        $('#pveinte').val(JSON.parse(localStorage.Qqslles3Pveinte))
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
        localStorage.Qqslles3Pdiez = JSON.stringify(pdiez);
    }

    if (p === 'nueve') {
        const pnueve = $('#pnueve').val();
        localStorage.Qqslles3Pnueve = JSON.stringify(pnueve);
    }

    if (p === 'ocho') {
        const pocho = $('#pocho').val();
        localStorage.Qqslles3Pocho = JSON.stringify(pocho);
    }

    if (p === 'siete') {
        const psiete = $('#psiete').val();
        localStorage.Qqslles3Psiete = JSON.stringify(psiete);
    }

    if (p === 'seis') {
        const pseis = $('#pseis').val();
        localStorage.Qqslles3Pseis = JSON.stringify(pseis);
    }

    if (p === 'cinco') {
        const pcinco = $('#pcinco').val();
        localStorage.Qqslles3Pcinco = JSON.stringify(pcinco);
    }

    if (p === 'uno') {
        const puno = $('#puno').val();
        localStorage.Qqslles3Puno = JSON.stringify(puno);
    }

    if (p === 'dos') {
        const pdos = $('#pdos').val();
        localStorage.Qqslles3Pdos = JSON.stringify(pdos);
    }

    if (p === 'tres') {
        const ptres = $('#ptres').val();
        localStorage.Qqslles3Ptres = JSON.stringify(ptres);
    }

    if (p === 'cuatro') {
        const pcuatro = $('#pcuatro').val();
        localStorage.Qqslles3Pcuatro = JSON.stringify(pcuatro);
    }

    if (p === 'once') {
        const ponce = $('#ponce').val();
        localStorage.Qqslles3Ponce = JSON.stringify(ponce);
    }
    
    if (p === 'doce') {
        const pdoce = $('#pdoce').val();
        localStorage.Qqslles3Pdoce = JSON.stringify(pdoce);
    }
    if (p === 'trece') {
        const ptrece = $('#ptrece').val();
        localStorage.Qqslles3Ptrece = JSON.stringify(ptrece);
    }
    if (p === 'catorce') {
        const pcatorce = $('#pcatorce').val();
        localStorage.Qqslles3Pcatorce = JSON.stringify(pcatorce);
    }
    if (p === 'quince') {
        const pquince = $('#pquince').val();
        localStorage.Qqslles3Pquince = JSON.stringify(pquince);
    }
    if (p === 'dieciseis') {
        const pdieciseis = $('#pdieciseis').val();
        localStorage.Qqslles3Pdieciseis = JSON.stringify(pdieciseis);
    }
    if (p === 'diecisiete') {
        const pdiecisiete = $('#pdiecisiete').val();
        localStorage.Qqslles3Pdiecisiete = JSON.stringify(pdiecisiete);
    }
    if (p === 'dieciocho') {
        const pdieciocho = $('#pdieciocho').val();
        localStorage.Qqslles3Pdieciocho = JSON.stringify(pdieciocho);
    }
    if (p === 'diecinueve') {
        const pdiecinueve = $('#pdiecinueve').val();
        localStorage.Qqslles3Pdiecinueve = JSON.stringify(pdiecinueve);
    }
    if (p === 'veinte') {
        const pveinte = $('#pveinte').val();
        localStorage.Qqslles3Pveinte = JSON.stringify(pveinte);
    }


}

function aceptado(p) {

    if (p === 'diez') {
        const pdiez = JSON.parse(localStorage.Qqslles3Pdiez);

        $('#lpdiez').addClass('fontTahu fa-2x text-info');
        $('#lpdiez').html(pdiez);
        $('#sinpdiez').hide();
    }

    if (p === 'nueve') {
        const pnueve = JSON.parse(localStorage.Qqslles3Pnueve);

        $('#lpnueve').addClass('fontTahu fa-2x text-info');
        $('#lpnueve').html(pnueve);
        $('#sinpnueve').hide();
    }

    if (p === 'ocho') {
        const pocho = JSON.parse(localStorage.Qqslles3Pocho);

        $('#lpocho').addClass('fontTahu fa-2x text-info');
        $('#lpocho').html(pocho);
        $('#sinpocho').hide();
    }

    if (p === 'seis') {
        const pseis = JSON.parse(localStorage.Qqslles3Pseis);

        $('#lpseis').addClass('fontTahu fa-2x text-info');
        $('#lpseis').html(pseis);
        $('#sinpseis').hide();
    }

    if (p === 'siete') {
        const psiete = JSON.parse(localStorage.Qqslles3Psiete);

        $('#lpsiete').addClass('fontTahu fa-2x text-info');
        $('#lpsiete').html(psiete);
        $('#sinpsiete').hide();
    }

    if (p === 'uno') {
        const puno = JSON.parse(localStorage.Qqslles3Puno);

        $('#lpuno').addClass('fontTahu fa-2x text-info');
        $('#lpuno').html(puno);
        $('#sinpuno').hide();
    }
    if (p === 'cinco') {
        console.log('aceptado = ' + p)
        const pcinco = JSON.parse(localStorage.Qqslles3Pcinco);
        $('#lpcinco').addClass('fontTahu fa-2x text-info');
        $('#lpcinco').html(pcinco);
        $('#lpcinco').show();
        $('#sinpcinco').hide();
    }
    if (p === 'dos') {
        const pdos = JSON.parse(localStorage.Qqslles3Pdos);

        $('#lpdos').addClass('fontTahu fa-2x text-info');
        $('#lpdos').html(pdos);
        $('#sinpdos').hide();
    }
    if (p === 'tres') {
        const ptres = JSON.parse(localStorage.Qqslles3Ptres);

        $('#lptres').addClass('fontTahu fa-2x text-info');
        $('#lptres').html(ptres);
        $('#sinptres').hide();
    }
    if (p === 'cuatro') {
        const pcuatro = JSON.parse(localStorage.Qqslles3Pcuatro);

        $('#lpcuatro').addClass('fontTahu fa-2x text-info');
        $('#lpcuatro').html(pcuatro);
        $('#sinpcuatro').hide();
    }

    if (p === 'once') {
        const ponce = JSON.parse(localStorage.Qqslles3Ponce);

        $('#lponce').addClass('fontTahu fa-2x text-info');
        $('#lponce').html(ponce);
        $('#sinponce').hide();
    }

    if (p === 'doce') {
        const pdoce = JSON.parse(localStorage.Qqslles3Pdoce);

        $('#lpdoce').addClass('fontTahu fa-2x text-info');
        $('#lpdoce').html(pdoce);
        $('#sinpdoce').hide();
    }

    if (p === 'trece') {
        const ptrece = JSON.parse(localStorage.Qqslles3Ptrece);

        $('#lptrece').addClass('fontTahu fa-2x text-info');
        $('#lptrece').html(ptrece);
        $('#sinptrece').hide();
    }

    if (p === 'catorce') {
        const pcatorce = JSON.parse(localStorage.Qqslles3Pcatorce);

        $('#lpcatorce').addClass('fontTahu fa-2x text-info');
        $('#lpcatorce').html(pcatorce);
        $('#sinpcatorce').hide();
    }
    if (p === 'quince') {
        const pquince = JSON.parse(localStorage.Qqslles3Pquince);

        $('#lpquince').addClass('fontTahu fa-2x text-info');
        $('#lpquince').html(pquince);
        $('#sinpquince').hide();
    }
    if (p === 'dieciseis') {
        const pdieciseis = JSON.parse(localStorage.Qqslles3Pdieciseis);

        $('#lpdieciseis').addClass('fontTahu fa-2x text-info');
        $('#lpdieciseis').html(pdieciseis);
        $('#sinpdieciseis').hide();
    }
    if (p === 'diecisiete') {
        const pdiecisiete = JSON.parse(localStorage.Qqslles3Pdiecisiete);

        $('#lpdiecisiete').addClass('fontTahu fa-2x text-info');
        $('#lpdiecisiete').html(pdiecisiete);
        $('#sinpdiecisiete').hide();
    }
    if (p === 'dieciocho') {
        const pdieciocho = JSON.parse(localStorage.Qqslles3Pdieciocho);

        $('#lpdieciocho').addClass('fontTahu fa-2x text-info');
        $('#lpdieciocho').html(pdieciocho);
        $('#sinpdieciocho').hide();
    }
    if (p === 'diecinueve') {
        const pdiecinueve = JSON.parse(localStorage.Qqslles3Pdiecinueve);

        $('#lpdiecinueve').addClass('fontTahu fa-2x text-info');
        $('#lpdiecinueve').html(pdiecinueve);
        $('#sinpdiecinueve').hide();
    }
    if (p === 'veinte') {
        const pveinte = JSON.parse(localStorage.Qqslles3Pveinte);

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
