<template>
    <div class="container" v-if="!isLoading">
        <loading :active.sync="isLoading"
                 :is-full-page="false"></loading>
        <div class="row">
            <div class="col-md-4" v-for="news in newsList">
                <SingleNewsLayout :news="news"></SingleNewsLayout>
            </div>
        </div>
    </div>
</template>

<script>
import SingleNewsLayout from "../Layout/News/SingleNewsLayout";

export default {
    name: "News",
    components: {
        SingleNewsLayout
    },
    data() {
        return {
            newsList: [],
            isLoading: false,
        }
    },
    methods: {
        getNews() {
            axios.get(`${APP_URL}/api/news`)
                .then(res => {
                    this.newsList = res.data.newsList;
                    this.isLoading = false;
                })
        }
    },
    created() {
        this.isLoading = true;
        this.getNews();
    }
}
</script>

<style scoped>

</style>
