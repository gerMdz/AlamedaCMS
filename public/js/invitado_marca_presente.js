$(document).ready(function() {
    $('.js-cambia-presente').on('click', function(e) {
        e.preventDefault();
        const spanPresente = $(this).data('presente');
        $('.aviso-presente').html('');

            // alert(this.data('presente'));
        const $link = $(e.currentTarget);

        $link.toggleClass('fa fa-check-square-o').toggleClass('fa fa-square-o');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            console.log(data.presente)
            $('#'+spanPresente).html('*');
        })
    });
});
