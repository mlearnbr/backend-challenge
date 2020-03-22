/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', {
    template: '#modal-template'
  })
  
  var app = new Vue({
    el: '#vue-wrapper',
  
    data: {
      items: [],
      hasError: true,
      hasDeleted: true,
      hasAgeError: true,
      showModal: false,
      showModalCreate:false,
      e_name: '',

      //delete
      e_age: '',
      e_id: '',
      e_profession: '',
      // adequate
      e_msisdn: '',
      e_access_level:'',
      password:'',
      newItem: { 'name': '', 'msisdn': '', 'access_level':'', 'password':'' },
     },
    mounted: function mounted() {
      this.getVueItems();
    },
    methods: {
      getVueItems: function getVueItems() {
        var _this = this;
  
        axios.get('/vueitems').then(function (response) {
          _this.items = response.data;
          console.log('itens: ', _this.items );
        });
      },
      setVal(val_id, val_name, val_access_level) {
          this.e_id = val_id;
          this.e_name = val_name;
          this.e_access_level = val_access_level;
        },
  
      createItem: function createItem() {
        var _this = this;
        var input = this.newItem;
        //this.showModalCreate=true;
       console.log('input: ',input);
        if (input['name'] == '' || input['msisdn'] == '' || input['access_level'] == '' || input['password'] == ''  ) {
            this.hasError = false;
        } else {
          this.hasError = true;
          axios.post('/vueitems', input).then(function (response) {
            _this.newItem = { 'name': '', 'msisdn': '', 'access_level':'', 'password':'' };
            _this.getVueItems();
          })
          .then(response => { 
            console.log(response)
        })
        .catch(error => {
            console.log(error.response)
        });
          this.hasDeleted = true;
        }
      },
      editItem: function(){
           var i_val_1 = document.getElementById('e_id');
           var n_val_1 = document.getElementById('e_name');
        //    var a_val_1 = document.getElementById('e_age');
           //var p_val_1 = document.getElementById('e_profession');
           var a_val_1 = document.getElementById('e_access_level');

  
           console.log();
            axios.post('/edititems/' + i_val_1.value, {val_1: n_val_1.value, val_2:a_val_1.value })
              .then(response => {
                this.getVueItems();
                this.showModal=false
              }).then(response => { 
                console.log(response)
            })
            .catch(error => {
                console.log(error.response)
            });
            this.hasDeleted = true;
          
    },
      deleteItem: function deleteItem(item) {
        var _this = this;
        axios.post('/vueitems/' + item.id).then(function (response) {
          _this.getVueItems();
          _this.hasError = true, 
          _this.hasDeleted = false
          
        });
      }
    }
  });

