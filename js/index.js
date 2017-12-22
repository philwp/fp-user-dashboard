console.log('WebPack is pretty neat! Suck it, haters.');

import Vue from 'vue';

import hello from './components/hello.vue';

new Vue({
  el: '#app',
  components: {
    'hello': hello
  }
});