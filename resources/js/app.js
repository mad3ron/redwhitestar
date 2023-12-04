import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './axios';

import 'chartjs-plugin-zoom';

window.$ = window.jQuery = require('jquery');
