<template>
    <div>
        <div class="users" v-if="!taskVisibility">
            <h1 class="h3 mb-4 text-gray-800">Users</h1>

            <div class="table-responsive py-5 bg-white">
                <table class="table table-hover">
                    <thead>
                        <th class="px-4">User Details</th>
                        <th class="px-4">Total Tasks</th>
                        <th class="px-4">Last Updated</th>
                        <th class="px-4"></th>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td class="px-4">{{ user.name }} <small class="text-muted d-block">Active {{ user.last_login_human }}</small></td>
                            <td class="px-4">{{ user.tasks_count }}</td>
                            <td class="px-4">{{ user.last_update_human }} <small class="text-muted d-block">{{ user.last_update_time_human }}</small></td>
                            <td class="dropdown">
                                <a
                                    href="#"
                                    id="opt"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="text-muted">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-primary">
                                    <a class="dropdown-item btn btn-default" @click='checkTasks(user)'><i class="fa fa-tasks"></i> View all tasks</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <user-tasks v-on:userTasks:back="backToList" v-on:userTasks:tasks="updateUserTasks" :userTasks="userTasks" :user="user" v-bind:visible="taskVisibility"></user-tasks>
    </div>

</template>

<script>
    export default {
        props: ['visible'],
        data() {
            return {
                users: [],
                userTasks: [],
                user: [],
                taskVisibility: false
            }
        },
        mounted() {
            this.userLists();
            Echo.private('todo')
            .listen('TaskAdded', (e) => {
                this.userLists();
            });
            Echo.private('todo')
            .listen('TaskDeleted', (e) => {
                this.userLists();
            });
        },
        methods: {
            userLists() {
                axios.get('/users').then(response => {
                    this.users = response.data;
                });
            },
            checkTasks(user) {
                this.taskVisibility = true;
                this.user = user;
                axios.get(`/users/${user.uId}`).then(response => {
                    this.userTasks = response.data;
                })
                .catch(function (error) {
                    // let $err = error.response.data.errors
                });
            },
            backToList() {
                this.taskVisibility = false;
                this.userTasks = this.userTasks;
            },
            updateUserTasks(tasks) {
                this.userTasks = tasks;
            }
        }
    };
</script>
