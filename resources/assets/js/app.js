
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

    ready: function() {
        this.created();
    },
    created(){
        axios.get('posts') 
            .then(response => {
              console.log(response);
              //alert(response);
              this.posts = response.data; // we are putting data into our post array
            })
            .catch(function(){
              console.log('FAILURE!!');
        });
    },
    methods:{
        addPost(){
            axios.post('addPost', {
                content: this.content
            }) 
            .then(function(response){
              console.log(response);
              if(response.status===200) { // 200 - response is done
                //alert('your post has beed added');
                postText: '';
                app.posts = response.data;
              }
            })
            .catch(function(){
              console.log('FAILURE!!');
        });
      }
    }
});