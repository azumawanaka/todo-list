require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('task-lists', require('./components/TaskLists.vue').default);
Vue.component('task-form', require('./components/TaskForm.vue').default);
Vue.component('task-edit-form', require('./components/EditTaskForm.vue').default);
Vue.component('alert-box', require('./components/AlertBox.vue').default);

const app = new Vue({
    el: '#app'
});
