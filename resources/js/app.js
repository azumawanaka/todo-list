require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(require('vue-moment'));

Vue.component('task-lists', require('./components/TaskLists.vue').default);
Vue.component('task-form', require('./components/TaskForm.vue').default);
Vue.component('edit-form', require('./components/EditForm.vue').default);
Vue.component('task-reminder', require('./components/TaskReminder.vue').default);
Vue.component('user-lists', require('./components/UserLists.vue').default);
Vue.component('user-tasks', require('./components/UsersTaskLists.vue').default);
Vue.component('user-task-form', require('./components/UserTaskForm.vue').default);

const app = new Vue({
    el: '#app'
});
