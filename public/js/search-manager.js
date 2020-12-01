$(document).ready(function() {

    $('.js-user-autocomplete').each(function () {

        var autocompleteUrl = $(this).data('autocomplete-url');
        var role = $(this).data('role')



        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    console.log(role);
                    console.log('-');
                    console.log(autocompleteUrl);
                    $.ajax({
                        url: autocompleteUrl+'?role='+role+'&query='+query
                    }).then(function(data) {
                        cb(data.users);
                    });
                },
                displayKey: 'email',
                debounce: 500 // cada 1/2 second
            }
        ]);
    })
});