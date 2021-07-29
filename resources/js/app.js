require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('task-lists', require('./components/TaskLists.vue').default);
Vue.component('task-form', require('./components/TaskForm.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        tasks: []
    },
    created() {
        this.taskLists();
        Echo.private('todo-list')
        .listen('TaskAdded', (e) => {
            this.tasks.push({
                user: e.user,
                summary: e.tasks.summary,
                description: e.tasks.description,
                due_date: e.tasks.due_date,
            });
        });
    },
    methods: {
        taskLists() {
            axios.get('tasks').then(response => {
                this.tasks = response.data;
            });
        },
        saveTask(tasks) {
            this.tasks.push(tasks);

            axios.post('/store', tasks).then(function (response) {
                $('#newTask').modal('toggle');
            }).catch(function (error) {
                // error.response.data.errors
            });
        }
    }
});
