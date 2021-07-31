<template>
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="editTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                </div>
                <form v-on:submit="editTask">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="summary" id="summary" class="form-control custom-field" placeholder="Summary" v-model="task.summary">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control custom-field" cols="30" rows="5" placeholder="Description" v-model="task.description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" id="due_date" name="due_date" class="form-control custom-field" placeholder="Due date" v-model="task.due_date">
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
    export default {
        data() {
            return {
               task: {
                    id: '',
                    summary: '',
                    description: '',
                    due_date: ''
               }
            }
        },
        methods: {
            editTask(e) {
                e.preventDefault()
                axios.put(`/tasks`, this.task).then(response => {
                    this.$emit('task:edited', response.data)

                    this.task.summary = ''
                    this.task.description = ''
                    this.task.due_date = ''

                    $('#editTask').modal('toggle')
                })
                .catch(function (error) {
                    // let $err = error.response.data.errors
                })
            }
        }
    }
</script>
