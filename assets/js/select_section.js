// import $ from 'jquery';
// import 'select2';                       // globally assign select2 fn to $ element
// import 'select2/dist/css/select2.css';  // optional if you have css loader
// require('../css/app.css');
const $ = require('jquery');
require('selectize');
require('selectize/dist/css/selectize.css')


$(function () {
    $('#entrada_section_section').selectize({
        create: true,
        sortField: "text",
    });


    console.log('select2Modal')

    // $("#modalPlantillaWeb").on('shown.bs.modal', function (e) {
    //         $(this).find('.select2-modal').select2({
    //             dropdownParent: $(this).find('.modal-body'),
    //             tags: true
    //         });
    //     });
});

