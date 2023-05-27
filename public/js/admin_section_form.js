$(document).ready(function () {
    const $originSelect = $('.js-section-form-origin');
    const $secondaryTarget = $('.js-secondary-target');
    const $btn_guardar = $('.btn-guardar');
    const $btnPrincipal = $('.btn-principal');

    $originSelect.on('change', function () {


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
                    .removeClass('d-none');
            }
        });
    });

    $btn_guardar.on('click', function (e) {
        e.preventDefault();
        console.log($(this).data('id'));
        let $value = $('#' + $(this).data('id')).val();
        console.log($value);

        fetch('/admin/section/image/change_order/section_image?id_sectionImage=' + $(this).data("id") + '&order_sectionImage=' + $value,
            {
                method: 'GET',

            })
            .then(function (response) {
                return response.json();
            })
            .then(function (result) {
                // alert(result.message);
            })
            .catch(function (error) {
                console.log('Request failed', error);
            });

    });

    $btnPrincipal.on('click', function (e) {
        console.log('ppal');
        console.log($(this).data('id'));
        fetch('/admin/section/image/change_principal/section_image?id_sectionImage=' + $(this).data("id"),
            {
                method: 'GET',

            })
            .then(response => {
                return response.json();
            }).then(data => {
            // Work with JSON data here
            console.log(data.principal);
            location.reload();
        })
            .catch(function (error) {
                console.log('Request failed', error);
            });
    });

});
