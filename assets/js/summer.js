import $ from 'jquery';
import 'popper.js';
 import 'bootstrap';
 import 'bootstrap/dist/css/bootstrap.min.css';

import CodeMirror from 'codemirror/lib/codemirror';
import 'codemirror/lib/codemirror.css';
import 'codemirror/mode/xml/xml';
import 'codemirror/theme/monokai.css'

import 'summernote/dist/summernote-bs4';
import 'summernote/dist/summernote-bs4.css';

$(".summernote").summernote({
    height: 150,   //set editable area's height
    codemirror: { // codemirror options
        CodeMirrorConstructor: CodeMirror,
        theme: 'monokai'
    },
    toolbar: [
        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
        ['font style', ['fontname', 'fontsize', 'color', 'bold', 'italic',
            'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['paragraph style', ['style', 'ol', 'ul', 'paragraph', 'height']],
        ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
    ],

});
