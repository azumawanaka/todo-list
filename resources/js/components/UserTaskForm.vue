<template>
    <div class="modal fade" id="userTask" tabindex="-1" role="dialog" aria-labelledby="userTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userTaskLabel">New Task {{ user }}</h5>
                </div>
                <form v-on:submit="createTask">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control custom-field" name="summary" placeholder="Summary" v-model="task.summary">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control custom-field" cols="30" rows="5" placeholder="Description" v-model="task.description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control custom-field" name="due_date" placeholder="Due date" v-model="task.due_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-dark btn-md">Save</button>
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
        props: ["user"],
        data() {
            return {
               task: {
                    id: this.user.uId,
                    summary: '',
                    description: '',
                    due_date: '',
               }
            }
        },
        watch: {
            user: function () {
                this.task.id = this.user.uId
            }
        },
        methods: {
            createTask(e) {
                e.preventDefault()
                axios.post('/users', this.task).then(response => {
                    this.$emit('task:created', response.data)

                    $('#userTask').modal('toggle')

                    this.task.summary = ''
                    this.task.description = ''
                    this.task.due_date = ''
                })
                .catch(function (error) {
                    // let $err = error.response.data.errors
                })
            }
        }
    }
</script>
