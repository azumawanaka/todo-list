<template>
    <div class="d-flex align-items-center justify-content-end px-3">
        <div class="page-rows text-muted mr-5">
            Rows per page: <select id="page_rows" @change="onChange($event)">
                <option v-for="row in pageRows" :value="row" :key="row">{{ row }}</option>
            </select>
        </div>
        <span class="mr-4 text-muted">{{ tasks.from }} - {{ tasks.to }} of {{ tasks.total }}</span>
        <div>
            <a href="#" @click="prevPage" class="prevNext text-dark"><i class="fa fa-angle-left"></i></a>
            <a href="#" @click="nextPage" class="prevNext text-dark"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</template>

<script>

export default {
    props: ["tasks", "limit", "currentPage", "user"],
    data() {
        return {
            pageRows: [5, 10, 15],
            current: this.currentPage,
            limits: this.limit,
        }
    },
    watch: {
        currentPage: function () {
            this.current = this.currentPage
        },
        limit: function () {
            this.limits = this.limit
        }
    },
    methods: {
        onChange(event) {
            this.limits = parseInt(event.target.value);
            this.changePage(this.current, this.limits);
        },
        prevPage() {
            if (this.current > 1) {
                this.current--;
                this.changePage(this.current, this.limits);
            }
        },
        nextPage() {
            if (this.tasks.last_page > this.current) {
                this.current++;
                this.changePage(this.current, this.limits);
            }
        },
        changePage(currentPage, limit) {
            axios.get(`/users/${this.user.uId}?page=${currentPage}&limit=${limit}`)
            .then(response => {
                this.$emit('paginateTaskList:paginate', response.data);
            });
        }
    }
}
</script>
