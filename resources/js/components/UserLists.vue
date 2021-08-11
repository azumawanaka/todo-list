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
                        <tr v-for="user in users.data" :key="user.id">
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
                <pagination v-on:paginateUser:paginate="paginatePage" :users="users" :limit="limit" :currentPage="currentPage"></pagination>
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
                users: {},
                userTasks: {},
                user: [],
                taskVisibility: false,
                limit: 5,
                currentPage: 1,
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
                axios.get(`/users?page=${this.currentPage}&limit=${this.limit}`).then(response => {
                    this.users = response.data;
                    return response.data;
                }).then(data => {
                    this.users = data;
                });
            },
            checkTasks(user) {
                this.taskVisibility = true;
                this.user = user;
                axios.get(`/users/${user.uId}?page=${this.currentPage}&limit=${this.limit}`).then(response => {
                    this.userTasks = response.data;
                    return response.data;
                }).then(data => {
                    this.userTasks = data;
                });
            },
            backToList() {
                this.taskVisibility = false;
                this.userTasks = this.userTasks;
            },
            updateUserTasks(tasks) {
                this.userTasks = tasks;
            },
            paginatePage(data) {
                this.users = data;
                this.currentPage = data.current_page;
            }
        }
    };
</script>
