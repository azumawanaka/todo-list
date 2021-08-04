<template>
    <div v-if="visible">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <a href="javascript:void()" @click="goBack()" class="btn btn-default h2 text-dark"><i class="fa fa-arrow-left"></i> {{ user.name }}</a>
            <a href="#" class="btn btn-default text-dark" @click="newTask(user)" data-toggle="modal" data-target="#userTask"><i class="fa fa-plus-square"></i> Add Task</a>
        </div>
        <h5>All Tasks</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Task Summary</th>
                    <th>Status</th>
                    <th>Due date</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="task in userTasks">
                        <td>{{ task.summary }} <small class="text-muted d-block">Active {{ task.updated_at_human }}</small></td>
                        <td>{{ task.completed_at !== null ? 'Completed' : 'Incomplete' }}</td>
                        <td>{{ task.due_date_carbon }} <small class="text-muted d-block">{{ task.due_date_time_carbon }}</small></td>
                        <td class="dropdown">
                            <a href="#" class="text-muted">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <user-task-form v-on:task:created="taskCreated" :user="user"></user-task-form>
    </div>
</template>

<script>
    export default {
        props: ['userTasks', 'user', 'visible'],
        data() {
            return {
                task: []
            }
        },
        methods: {
            goBack() {
                this.$emit('userTasks:back');
            },
            newTask(user) {
                this.user = user;
            },
            taskCreated(task) {
                this.task.push(task);
            }
        }
    };
</script>
