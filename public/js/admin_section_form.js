$(document).ready(function() {
    const $originSelect = $('.js-section-form-origin');
    const $secondaryTarget = $('.js-secondary-target');

    $originSelect.on('change', function() {


        $.ajax({
            url: $originSelect.data('secondaty-url'),
            data: {
                typeOrigin: $originSelect.val()
            },
            success: function (html) {
                if (!html) {
                    $secondaryTarget.find('select').remove();
                    $secondaryTarget.addClass('d-none');

                    return;
                }

                // Replace the current field and show
                $secondaryTarget
                    .html(html)
                    .removeClass('d-none')
            }
        });
    });
});
