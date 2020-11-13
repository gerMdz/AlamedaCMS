import '../css/admin.scss';
import 'eonasdan-bootstrap-datetimepicker';

$(function() {
    // Datetime picker initialization.
    // See https://eonasdan.github.io/bootstrap-datetimepicker/
    $('[data-toggle="datetimepicker"]').datetimepicker({
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check-circle-o',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
});

