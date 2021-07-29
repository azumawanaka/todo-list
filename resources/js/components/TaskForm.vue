<template>
    <div>
        <div class="col-md-12" v-if="errors.length">
            <strong>Please correct the following error(s):</strong>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input id="summary" type="text" class="form-control custom-field" name="summary" placeholder="Summary" v-model="summary">
            </div>
            <div class="form-group">
                <textarea name="description" id="description" class="form-control custom-field" cols="30" rows="5" placeholder="Description" v-model="description"></textarea>
            </div>
            <div class="form-group">
                <input id="due_date" type="datetime-local" class="form-control custom-field" name="due_date" placeholder="Due date" v-model="due_date">
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-12 text-center">
                <button class="btn btn-dark btn-md" @click="saveTask">Save</button>
            </div>
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                errors: [],
                summary: '',
                description: '',
                due_date: '',
            }
        },

        methods: {
            saveTask() {
                if (!this.summary) {
                    this.errors.push('Summary is required.');
                }
                if (!this.description) {
                    this.errors.push('Description is required.');
                }
                if (!this.due_date) {
                    this.errors.push('Due date is required.');
                }

                this.$emit('taskadded', {
                    user: this.user,
                    summary: this.summary,
                    description: this.description,
                    due_date: this.due_date,
                });

                this.summary = ''
                this.description = ''
                this.due_date = ''
            }
        }
    }
</script>
