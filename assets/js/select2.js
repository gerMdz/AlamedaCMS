import $ from 'jquery';
import 'select2';                       // globally assign select2 fn to $ element
import 'select2/dist/css/select2.css';  // optional if you have css loader

$(function () {
    $('.select2-enable').select2({
        placeholder: 'Seleccione item de la lista',
        allowClear: true,
        width: '100%'
    });

    console.log('select2')
});

