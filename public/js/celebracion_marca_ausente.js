$(document).ready(function () {
    $('.js-marca-ausente').on('click', function (e) {
        e.preventDefault();
        const spanAusente = $(this).data('celebracion');
        $('.' + spanAusente).hide();

        // alert(this.data('presente'));
        const $link = $(e.currentTarget);


        $.ajax({
            method: 'GET',
            url: $link.attr('href')
        }).done(function (data) {

            $('#' + spanAusente).html(data.ausentes + " ausentes");
        })
    });
});
