// import $ from 'jquery';
// import 'select2';                       // globally assign select2 fn to $ element
// import 'select2/dist/css/select2.css';  // optional if you have css loader
// require('../css/app.css');
const $ = require('jquery');
require('@selectize/selectize');
require('@selectize/selectize/dist/css/selectize.css');


$(function () {
    $('#entrada_section_section').selectize({
        create: true,
        sortField: 'text'
    });



});

