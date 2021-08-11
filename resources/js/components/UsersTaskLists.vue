<template>
    <div v-if="visible">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <a href="javascript:void()" @click="goBack()" class="btn btn-default h2 text-dark"><i class="fa fa-arrow-left"></i> {{ user.name }}</a>
            <a href="#" class="btn btn-default text-dark" @click="newTask(user)" data-toggle="modal" data-target="#userTask"><i class="fa fa-plus-square"></i> Add Task</a>
        </div>
        <h5>All Tasks</h5>
        <div class="table-responsive py-5 bg-white">
            <table class="table table-hover">
                <thead>
                    <th class="px-4">Task Summary</th>
                    <th class="px-4">Status</th>
                    <th class="px-4">Due date</th>
                    <th class="px-4"></th>
                </thead>
                <tbody>
                    <tr v-for="task in tasks.data">
                        <td class="px-4">{{ task.summary }} <small class="text-muted d-block">Active {{ task.updated_at_human }}</small></td>
                        <td class="px-4">{{ task.completed_at != null ? 'Completed' : 'Incomplete' }}</td>
                        <td class="px-4">{{ task.due_date_carbon }} <small class="text-muted d-block">{{ task.due_date_time_carbon }}</small></td>
                        <td class="dropdown">
                            <a href="#" class="text-muted">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <user-task-pagination v-on:paginateTaskList:paginate="paginatePage" :tasks="tasks" :limit="limit" :user="user" :currentPage="currentPage"></user-task-pagination>
        </div>

        <user-task-form v-on:task:created="taskCreated" :user="user" :currentPage="currentPage" :limit="limit"></user-task-form>
    </div>
</template>

<script>
    export default {
        props: ['userTasks', 'user', 'visible'],
        data() {
            return {
                limit: 5,
                currentPage: 1,
                tasks: {},
            }
        },
        watch: {
            userTasks: function () {
                this.tasks = this.userTasks
            }
        },
        created() {
            Echo.private('todo').listen('TaskUpdated', e => {
                this.tasksLists();
            });
            Echo.private('todo').listen('TaskDeleted', e => {
                this.tasksLists();
            });
        },
        methods: {
            tasksLists() {
                axios.get(`/users/${this.user.uId}?page=${this.currentPage}&limit=${this.limit}`).then(response => {
                    this.$emit("userTasks:tasks", response.data);
                });
            },
            goBack() {
                this.$emit('userTasks:back');
            },
            newTask(user) {
                this.user = user;
            },
            taskCreated(task) {
                this.tasks = task;
                this.currentPage = task.current_page;
                this.limit = task.limit;
            },
            paginatePage(task) {
                this.tasks = task;
                this.currentPage = task.current_page;
                this.limit = task.limit;
            }
        }
    };
</script>
