import Vue from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import {
    faSearch,
    faTable,
    faAngleLeft,
    faBars,
    faTimes,
    faComments,
    faStar,
    faBell,
    faExpandArrowsAlt,
    faThLarge,
    faUsers,
    faFile,
} from '@fortawesome/free-solid-svg-icons';

import {

} from '@fortawesome/free-brands-svg-icons';
import {
    faCircle,
    faEnvelope,
    faClock,
} from '@fortawesome/free-regular-svg-icons';

Vue.component('font-awesome-icon', FontAwesomeIcon);

library.add(
    faSearch,
    faTable,
    faAngleLeft,
    faBars,
    faTimes,
    faComments,
    faStar,
    faBell,
    faExpandArrowsAlt,
    faThLarge,
    faUsers,
    faFile,

    faCircle,
    faEnvelope,
    faClock,
);
