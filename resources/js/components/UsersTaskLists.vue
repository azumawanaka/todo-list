<template>
    <div v-if="visible">
        <h2 class="mb-4"><a href="#" class="text-dark"><i class="fa fa-arrow-left"></i> {{ user.name }}</a></h2>
        <h5>All Tasks</h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Task Summary</th>
                    <th>Status</th>
                    <th>Due date</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="task in userTasks">
                        <td>{{ task.summary }} <small class="text-muted d-block">Active {{ task.updated_at_human }}</small></td>
                        <td>{{ task.completed_at !== null ? 'Completed' : 'Incomplete' }}</td>
                        <td>{{ task.due_date_carbon }} <small class="text-muted d-block">{{ task.due_date_time_carbon }}</small></td>
                        <td class="dropdown">
                            <a href="#" class="text-muted">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['userTasks', 'user', 'visible']
    };
</script>
