<template>
    <div>
        <h5>Incomplete</h5>
        <div class="col-md-12">
            <div class="incomplete mb-4" v-for="(task, tId) in tasks" :key="tId" v-if="task.status === 0">
                <input class="form-check-input" name="status[]" type="checkbox" :value="task.id" :id="task.id" @change='updateActiveStatus()' v-model="taskId">
                <label class="form-check-label" :for="task.id">
                    {{ task.summary }} <br/>
                    <small class="text-muted"><i class="fa fa-clock-o"></i> {{ task.due_date }}</small>
                </label>
            </div>
        </div>
        <h5>Completed</h5>
        <div class="col-md-12">
            <div class="completed" v-for="(task, tId) in tasks" :key="tId" v-if="task.status === 1">
                <input class="form-check-input" type="checkbox" :value="task.id" :id="task.id" checked>
                <label class="form-check-label text-muted" :for="task.id">
                    {{ task.summary }} <br/>
                    <small><i class="fa fa-clock-o"></i> {{ task.due_date }}</small>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tasks'],
        data() {
            return {
                taskId: []
            }
        },
        methods: {
            updateActiveStatus() {
                const res = axios.put(`/tasks/${this.taskId}`);
                console.log( res.data );
            }
        }
    };
</script>
