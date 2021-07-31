<template>
    <div class="tasks">
        <h5>Incomplete</h5>
        <div class="col-md-12">
            <div class="item incomplete mb-4" v-for="task in tasks"  v-if="!task.completed_at">
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
                <a href="javascript:void()" class="text-info" @click='editTask(task)' data-toggle="modal" data-target="#editTask"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void()" class="text-danger" @click='deleteTask(task)'><i class="fa fa-times-circle-o"></i></a>
            </div>
        </div>
        <h5>Completed</h5>
        <div class="col-md-12">
            <div class="item completed" v-for="task in tasks" v-if="task.completed_at">
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
                <a href="javascript:void()" class="text-info" @click='editTask(task)' data-toggle="modal" data-target="#editTask"><i class="fa fa-pencil-square-o"></i></a>
                <a href="javascript:void()" class="text-danger" @click='deleteTask(task)'><i class="fa fa-times-circle-o"></i></a>
            </div>
        </div>

        <task-form v-on:task:created="taskCreated"></task-form>
        <task-edit-form v-on:task:edited="editTask"></task-edit-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                summary: '',
                description: '',
                due_date: '',
            }
        },
        created() {
            this.taskLists();
            Echo.private('todo')
            .listen('TaskAdded', (e) => {
                this.tasks.push({
                    summary: e.task.summary,
                    description: e.task.description,
                    due_date_human: e.task.due_date_human,
                });
            });
        },
        updated() {
            this.taskLists();
            Echo.private('todo')
            .listen('TaskAdded');
        },
        methods: {
            taskLists() {
                axios.get('/tasks').then(response => {
                    this.tasks = response.data;
                });
            },
            updateTaskStatus(task) {
                axios.put(`/tasks/${task.id}`, task).then(response => {
                    this.tasks = response.data;
                });
            },
            taskCreated(task) {
                this.tasks.push(task)
            },
            editTask(task) {
                this.tasks.push(task)
            },
            // taskEdited(task) {
            //     this.tasks.push(task)
            // },
            deleteTask(task) {
                if (confirm("Are you sure you want to delete this task?")) {
                    axios.delete(`/tasks/${task.id}`, task).then(response => {
                        this.tasks = response.data;
                    });
                }
            }
        }
    };
</script>
