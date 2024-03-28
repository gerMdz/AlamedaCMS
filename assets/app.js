/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';


/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('./styles/app.css');
require('./css/igles.css');
// require('../css/igle.scss');
require('./css/foundation-icons/foundation-icons.css');
require('./css/stream.css');
require('./css/styles.css');
// require('../fonts/univers/font.css');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
// import 'bootstrap';
global.$ = $;



console.log('Hola, y si, con webpack encore');
