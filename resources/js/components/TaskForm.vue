<template>
    <div>
        <div class="modal-body">
            <div class="form-group">
                <input id="summary" type="text" class="form-control custom-field" name="summary" placeholder="Summary" v-model="summary">
                <small class="text-danger">{{ summary_err }}</small>
            </div>
            <div class="form-group">
                <textarea name="description" id="description" class="form-control custom-field" cols="30" rows="5" placeholder="Description" v-model="description"></textarea>
                <small class="text-danger">{{ desc_err }}</small>
            </div>
            <div class="form-group">
                <input id="due_date" type="datetime-local" class="form-control custom-field" name="due_date" placeholder="Due date" v-model="due_date">
                <small class="text-danger">{{ ddate_err }}</small>
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
        props: [],
        data() {
            return {
                summary_err: '',
                desc_err: '',
                ddate_err: '',
                summary: '',
                description: '',
                due_date: '',
            }
        },
        methods: {
            saveTask() {
                if (!this.summary) {
                    this.summary_err = 'Summary is required.';
                }
                if (!this.description) {
                    this.desc_err = 'Description is required.';
                }
                if (!this.due_date) {
                    this.due_date = 'Due date is required.';
                }

                if (this.summary && this.description && this.due_date) {
                    this.$emit('taskadded', {
                        summary: this.summary,
                        description: this.description,
                        due_date: this.due_date,
                    });
                }

                this.summary = ''
                this.description = ''
                this.due_date = ''
            }
        }
    }
</script>
