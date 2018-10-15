/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("jquery");
window.axios = require('axios');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('material-types', require('./components/MaterialTypes.vue'));

/* const materialSearchViewModel = new Vue({
    el: '#materials',
    data: {
        materials: [],
        loading: false,
        error: false,
        query: ''
    },
    methods: {
	    search: function() {
	        // Clear the error message.
	        this.error = '';
	        // Empty the products array so we can fill it with the new products.
	        this.materials = [];
	        // Set the loading property to true, this will display the "Searching..." button.
	        this.loading = true;

	        // Making a get request to our API and passing the query to it.
	        axios.get('/api/s?' + this.query)
                .then(response => this.materials = reponse.data)
                .catch(error => {});
	    }
	}
}); 
*/
$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});
