
require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;

Vue.use(VueRouter,VueAxios, axios);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	msg: 'Update New Post: ',
    	content: '',
        posts: [],
    }, 

    methods:{
        addPost(){
            axios.post('addPost', {
                content: this.content
            }) 
            .then(function(response){
              console.log(response);
            })
            .catch(function(){
              console.log('FAILURE!!');
        });
      }
    }
});