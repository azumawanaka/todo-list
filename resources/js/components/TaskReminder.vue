<template>
    <div class="alert-area">
        <div class="alert-body shadow-sm rounded border" v-for="task in reminderTasks" v-if="remind">
            <div class="alert-box d-flex px-2 py-3">
                <div class="col-md-9">
                    <h5 class="font-weight-bolder">{{ task.summary }}</h5>
                    <p class="mb-0">{{ task.description }}</p>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <span class="clock-icon bg-warning d-flex align-items-center  justify-content-center"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>
            <div class="alert-footer p-2 text-right bg-light">
                <a href="javascript:void(0)" @click="updateReminder(task, 2)" class="text-dark"><small>Skip</small></a>
                <a href="javascript:void(0)" @click="updateReminder(task, 0)" class="text-dark"><small>Remind me later</small></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['reminderTasks'],
        data() {
            return {
                remind: true
            }
        },
        methods: {
            updateReminder(task, remind) {
                task.remind = remind;
                axios.put(`/tasks/${task.id}`, task).then(response => {
                    this.remind = false;
                })
                .catch(error => {
                    if (error.response && error.response.data) {
                       console.log(error.response.data.errors);
                    }
                });
            }
        }
    };
</script>
