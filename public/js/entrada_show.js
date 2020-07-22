$(document).ready(function() {
    $('.js-like-entrada').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        $link.toggleClass('fas fa-heart').toggleClass('far fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            $('.js-like-entrada-count').html(data.like);
        })
    });
});
