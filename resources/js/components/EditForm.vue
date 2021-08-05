<template>
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="editTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                </div>
                <form v-on:submit="updateTask">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" :class="['form-control custom-field', errors.summary ? 'is-invalid' : '']" autofocus="autofocus" name="summary" placeholder="Summary" v-model="currentTask.summary">
                            <span v-if="errors.summary" class="invalid-feedback" role="alert">
                                <strong>{{ errors.summary }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <textarea name="description" :class="['form-control custom-field', errors.description ? 'is-invalid' : '']" cols="30" rows="5" placeholder="Description" v-model="currentTask.description"></textarea>
                            <span v-if="errors.description" class="invalid-feedback" role="alert">
                                <strong>{{ errors.description }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" name="due_date" class="form-control custom-field" placeholder="Due date" :value="toDate(currentTask.due_date)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-dark btn-md">Update</button>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['currentTask'],
        data() {
            return {
               task: {
                    summary: '',
                    description: '',
                    due_date: '',
               },
               errors: [],
            }
        },
        created() {
            Echo.private('todo')
            .listen('TaskAdded', (e) => {
                this.taskLists();
            });
        },
        methods: {
            taskLists() {
                axios.get('/tasks');
            },
            updateTask(e) {
                e.preventDefault()
                axios.put(`/tasks/${this.currentTask.taskId}`, this.currentTask)
                    .then(response => {
                        $('#editTask').modal('toggle')

                        this.currentTask.summary = ''
                        this.currentTask.description = ''
                        this.currentTask.due_date = ''

                        this.errors.clear()
                    })
                    .catch(error => {
                        let err = error.response.data.errors;
                        this.errors = {
                            summary: err.summary ? err.summary.toString().replace(/[^\w\s]/gi, '') : null,
                            description: err.description ? err.description.toString().replace(/[^\w\s]/gi, '') : null,
                        };
                    });
            },
            toDate(date) {
                return moment(date).format("YYYY-MM-DDTHH:mm")
            }
        }
    }
</script>
