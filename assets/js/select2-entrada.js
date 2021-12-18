const $ = require('jquery');
require('select2')
require('select2/dist/css/select2.css')
$('.select2-entrada').select2({ width: '100%', placeholder: "Select an Option", allowClear: true })
console.log('select2-entrada');
