<template>
    <div>
        <div class="users" v-if="!taskVisibility">
            <h5>All Users</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>User Details</th>
                        <th>Total Tasks</th>
                        <th>Last Updated</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.name }} <small class="text-muted d-block">Active {{ user.last_update_human }}</small></td>
                            <td>{{ user.tasks_count }}</td>
                            <td>{{ user.last_update_human }} <small class="text-muted d-block">{{ user.last_update_time_human }}</small></td>
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

        <user-tasks v-on:userTasks:back="backToList" :userTasks="userTasks" :user="user" v-bind:visible="taskVisibility"></user-tasks>
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
        created() {
            this.userLists();
            Echo.private('todo')
            .listen('TaskAdded', (e) => {
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
            }
        }
    };
</script>
