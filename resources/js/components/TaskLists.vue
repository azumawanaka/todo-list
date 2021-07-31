<template>
    <div>
        <h5>Incomplete</h5>
        <div class="col-md-12">
            <div class="incomplete mb-4" v-for="task in tasks"  v-if="!task.completed_at">
                <input class="form-check-input" name="status[]" type="checkbox" :value="task.id" :id="'incomplete-' + task.id" @change='updateActiveStatus(task)' v-model="taskId">
                <label class="form-check-label" :for="'incomplete-' + task.id">
                    {{ task.summary }} <br/>
                    <small class="text-muted"><i class="fa fa-clock-o"></i> {{ task.due_date }}</small>
                </label>
            </div>
        </div>
        <h5>Completed</h5>
        <div class="col-md-12">
            <div class="completed" v-for="task in tasks"  v-if="task.completed_at">
                <input class="form-check-input" type="checkbox" :value="task.id" :id="'completed-' + task.id" @change='updateActiveStatus(task)' v-model="taskId" checked>
                <label class="form-check-label text-muted" :for="'completed-' + task.id">
                    {{ task.summary }} <br/>
                    <small><i class="fa fa-clock-o"></i> {{ task.due_date }}</small>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                taskId: []
            }
        },
        created() {
            this.taskLists();
        },
        methods: {
            taskLists() {
                axios.get('/tasks').then(response => {
                    this.tasks = response.data;
                });
            },
            updateActiveStatus(task) {
                axios.put(`/tasks/${this.taskId}`, task);
            }
        }
    };
</script>
