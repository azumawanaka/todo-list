<template>
    <div>
         <div class="form-check" v-for="task in tasks">
            <input class="form-check-input" type="checkbox" value="" :id="task.id">
            <label class="form-check-label" :for="task.id">
                {{ task.summary }} <br/>
                <small class="text-muted"><i class="fa fa-clock-o"></i> {{ task.due_date }}</small>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tasks']
    };
</script>
