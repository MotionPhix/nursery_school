import './bootstrap'
import '../css/app.css'

// import "@protonemedia/laravel-splade/dist/style.css";
import '../css/choices.scss'
import '../css/flatpickr.styl'

import { createApp } from 'vue/dist/vue.esm-bundler.js'
import { SpladePlugin, renderSpladeApp } from '@protonemedia/laravel-splade'

import 'vfonts/Inter.css'

import Switch from './components/switch.vue'

const el = document.getElementById('app')

createApp({
  render: renderSpladeApp({ el }),
})
  .use(SpladePlugin, {
    max_keep_alive: 10,
    transform_anchors: false,
    progress_bar: true,
    components: {
      Switch,
    },
  })
  .mount(el)