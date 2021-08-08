<template>
    <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="newTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTaskLabel">New Task</h5>
                </div>
                <form class="px-3" v-on:submit="createTask">
                    <div class="modal-body">
                        <div class="form-group input-group border-bottom">
                            <span class="d-flex align-items-center">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </span>
                            <input type="text" :class="['form-control custom-field', errors.summary ? 'is-invalid' : '']" autofocus="autofocus" name="summary" placeholder="Summary" v-model="task.summary">
                            <span v-if="errors.summary" class="invalid-feedback" role="alert">
                                <strong>{{ errors.summary }}</strong>
                            </span>
                        </div>
                        <div class="form-group input-group border-bottom">
                            <span class="pt-2">
                                <i class="fa fa-align-left" aria-hidden="true"></i>
                            </span>
                            <textarea name="description" :class="['form-control custom-field', errors.description ? 'is-invalid' : '']" cols="30" rows="5" placeholder="Description" v-model="task.description"></textarea>
                            <span v-if="errors.description" class="invalid-feedback" role="alert">
                                <strong>{{ errors.description }}</strong>
                            </span>
                        </div>
                        <div class="form-group input-group border-bottom">
                            <span class="d-flex align-items-center">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </span>
                            <input type="datetime-local" class="form-control custom-field" name="due_date" placeholder="Due date" v-model="task.due_date">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="col-md-8 text-center">
                            <button type="submit" class="btn btn-dark btn-block rounded-btn ">Save</button>
                        </div>
                        <div class="col-md-8 text-center">
                            <button type="button" class="btn btn-white btn-block rounded-btn" data-dismiss="modal">Close</button>
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
        data() {
            return {
               task: {
                    summary: '',
                    description: '',
                    due_date: moment().format("YYYY-MM-DDTHH:mm"),
               },
               errors: [],
            }
        },
        methods: {
            createTask(e) {
                e.preventDefault()
                axios.post('/tasks', this.task).then(response => {
                    this.$emit('task:created', response.data)
                    $('#newTask').modal('toggle')

                    this.task.summary = ''
                    this.task.description = ''
                    this.task.due_date = ''

                    this.errors.clear()
                })
                .catch(error => {
                    if (error.response && error.response.data) {
                        let err = error.response.data.errors;
                        this.errors = {
                            summary: err.summary ? err.summary.toString().replace(/[^\w\s]/gi, '') : null,
                            description: err.description ? err.description.toString().replace(/[^\w\s]/gi, '') : null,
                        };
                    }
                });
            }
        }
    }
</script>
