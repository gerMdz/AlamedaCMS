require('../css/app.css');
const $ = require('jquery');
console.log('Select2 Parent');

require('select2');
require('select2/dist/css/select2.css');
$('.select2-enable').select2({ width: '100%', placeholder: "Seleccione un item", allowClear: true });
