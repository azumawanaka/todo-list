<template>
    <div class="d-flex align-items-center justify-content-end px-3">
        <div class="page-rows text-muted mr-5">
            Rows per page: <select id="page_rows" @change="onChange($event)">
                <option v-for="row in pageRows" :value="row" :key="row">{{ row }}</option>
            </select>
        </div>
        <span class="mr-4 text-muted">{{ users.from }} - {{ users.to }} of {{ users.total }}</span>
        <div>
            <a href="#" @click="prevPage" class="prevNext text-dark"><i class="fa fa-angle-left"></i></a>
            <a href="#" @click="nextPage" class="prevNext text-dark"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</template>

<script>

export default {
    props: ["users", "limit", "currentPage"],
    data() {
        return {
            pageRows: [5, 10, 15],
            current: this.currentPage
        }
    },
    watch: {
        currentPage: function () {
            this.current = this.currentPage
        }
    },
    methods: {
        onChange(event) {
            this.limit = parseInt(event.target.value);
            this.changePage(this.current, this.limit);
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.current--;
                this.changePage(this.current, this.limit);
            }
        },
        nextPage() {
            if (this.users.last_page > this.currentPage) {
                this.current++;
                this.changePage(this.current, this.limit);
            }
        },
        changePage(currentPage, limit) {
            axios.get(`/users?page=${currentPage}&limit=${limit}`).then(response => {
                this.$emit('paginateUser:paginate', response.data);
            });
        }
    }
}
</script>
