import '../css/app.css';
import './bootstrap';

// import "@protonemedia/laravel-splade/dist/style.css";
import "@protonemedia/laravel-splade/dist/jodit.css";
import '../css/choices.scss';
import '../css/flatpickr.styl';

import { SpladePlugin, renderSpladeApp } from '@protonemedia/laravel-splade';
import { createApp } from 'vue/dist/vue.esm-bundler.js';

import 'vfonts/Inter.css';

import { MenuItem } from '@headlessui/vue';
import { IconCalendarTime } from '@tabler/icons-vue';

import Filter from './components/filter.vue';
import Selectable from './components/selectable.vue';
import Switch from './components/switch.vue';

const el = document.getElementById('app')

createApp({
  render: renderSpladeApp({ el }),
})
  .use(SpladePlugin, {
    max_keep_alive: 10,
    transform_anchors: false,
    progress_bar: true,
    components: {
      Filter,
      Switch,
      Selectable,
      IconCalendarTime,
      MenuItem,
    },
  })
  .mount(el)
