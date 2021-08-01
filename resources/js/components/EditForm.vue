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
                            <input type="text" name="summary" class="form-control custom-field" placeholder="Summary" v-model="currentTask.summary">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control custom-field" cols="30" rows="5" placeholder="Description" v-model="currentTask.description"></textarea>
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
                    due_date: ''
               }
            }
        },
        methods: {
            updateTask(e) {
                e.preventDefault()
                axios.put(`/tasks/${this.currentTask.taskId}`, this.currentTask).then(response => {
                    this.$emit('task:edited', response.data)

                    $('#editTask').modal('toggle')

                    this.currentTask.summary = ''
                    this.currentTask.description = ''
                    this.currentTask.due_date = ''
                })
                .catch(function (error) {
                    // let $err = error.response.data.errors
                })
            },
            toDate(date) {
                return moment(date).format("YYYY-MM-DDTHH:mm")
            }
        }
    }
</script>
