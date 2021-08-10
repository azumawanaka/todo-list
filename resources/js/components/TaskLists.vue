<template>
    <div class="tasks">
        <h5>Incomplete</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item border-0 bg-transparent d-flex" v-for="task in tasks"  v-if="!task.completed_at">
                <div class="item incomplete w-20">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="status[]"
                        :value="task.id"
                        :id="'incomplete-' + task.id"
                        @change='updateTaskStatus(task)'
                        v-model="task.completed_at">
                    <label class="form-check-label" :for="'incomplete-' + task.id">
                        {{ task.summary }} <br/>
                        <small class="text-muted"><i class="fa fa-clock-o"></i> {{ task.due_date_human }}</small>
                    </label>
                </div>
                <div class="opt">
                    <a href="javascript:void()" class="text-info" @click='editTask(task)' data-toggle="modal" data-target="#editTask"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="javascript:void()" class="text-danger" @click='removeTask(task)'><i class="fa fa-times-circle-o"></i></a>
                </div>
            </li>
        </ul>

        <h5>Completed</h5>
        <ul class="list-group">
            <li class="list-group-item border-0 bg-transparent d-flex" v-for="task in tasks" v-if="task.completed_at">
                <div class="item completed w-20">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="status[]"
                        :value="task.id"
                        :id="'completed-' + task.id"
                        @change='updateTaskStatus(task)'
                        v-model="task.completed_at">
                    <label class="form-check-label text-muted" :for="'completed-' + task.id">
                        {{ task.summary }} <br/>
                        <small><i class="fa fa-clock-o"></i> {{ task.due_date_human }}</small>
                    </label>
                </div>
                <div class="opt">
                    <a href="javascript:void()" class="text-info" @click='editTask(task)' data-toggle="modal" data-target="#editTask"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="javascript:void()" class="text-danger" @click='removeTask(task)'><i class="fa fa-times-circle-o"></i></a>
                </div>
            </li>
        </ul>

        <task-form v-on:task:created="taskCreated"></task-form>
        <edit-form v-on:task:edited="taskEdited" :currentTask="currentTask"></edit-form>
        <task-reminder :reminderTasks="reminderTasks"></task-reminder>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                currentTask: [],
                summary: '',
                description: '',
                due_date: '',
                reminderTasks: [],
            }
        },
        mounted() {
            Echo.private('todo')
            .listen('TaskReminder', e => {
                this.reminderTasks.push(e.task);
            });
        },
        created() {
            this.taskLists();
            Echo.private('todo').listen('TaskAdded', e => {
                this.taskLists();
            });
        },
        methods: {
            taskLists() {
                axios.get('/tasks').then(response => {
                    this.tasks = response.data;
                });
            },
            updateTaskStatus(task) {
                axios.put(`/tasks/${task.id}`, task);
            },
            removeTask(task) {
                axios.delete(`/tasks/${task.id}`).then( (response) =>{
                    this.tasks = response.data;
                });
            },
            editTask(task) {
                this.currentTask = {
                    taskId: task.id,
                    summary: task.summary,
                    description: task.description,
                    due_date: task.due_date
                }
            },
            taskCreated(task) {
                this.tasks.unshift(task)
            },
            taskEdited(task) {
                this.tasks = task;
            }
        }
    };
</script>
