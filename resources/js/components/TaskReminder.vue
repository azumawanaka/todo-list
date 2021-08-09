<template>
    <div class="alert-area">
        <div class="card alert-box" v-for="task in reminderTasks" v-if="!task.remind">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">{{ task.summary }}</h6>
                <p class="card-text">{{ task.description }}</p>
                <a href="#" class="card-link text-muted">Skip</a>
                <a href="#" class="card-link">Remind me later</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['reminderTasks'],
    };
</script>
