<template>
    <div class="users">
        <h5>Users</h5>
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
                        <td>{{ user.uname }} <small class="text-muted d-block">Active {{ user.last_login_human }}</small></td>
                        <td>{{ user.total_tasks }}</td>
                        <td>{{ user.last_update_human }} <small class="text-muted d-block">{{ user.last_update_time_human }}</small></td>
                        <td><a href="#" class="text-muted"><i class="fa fa-ellipsis-v"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: []
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
                    console.log(response.data);
                });
            }
        }
    };
</script>
