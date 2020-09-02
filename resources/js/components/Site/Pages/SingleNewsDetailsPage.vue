<template>
    <div class="container-fluid">
        <div class="row">
            <loading :active.sync="isLoading"
                     :is-full-page="false"></loading>
            <div class="col-md-6 col-lg-6 m-auto" v-if="!isLoading">
                <div class="blog-area shadow">
                    <div class="blog-read-title customize-sub-category-header p-3"
                         style="color: white; font-size: 20px; background-color: rgb(0 172 242)">
                        {{ news.title }}
                    </div>
                    <div class="row border ml-0 mr-0">
                        <div class="col-md-12 col-lg-12">
                            <div class="blog-read-img-comment" style="padding:2% 25%">
                                <div class="blog-read-img border">
                                    <img style="max-width: 100%;"
                                         :src='`/news/images/${news.image}`'
                                         :alt="news.title">
                                </div>
                            </div>

                            <div class="blog-read-content-area border1 p-3">
                                <div class="blog-description" spellcheck="false" v-html="news.description">

                                </div>

                                <div class="date_authore mt-3">
                                    <p>Skrevet af Anja
                                        in {{ news.created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "SingleNewsDetailsPage",
    data() {
        return {
            newsSlug: null,
            news: null,
            isLoading: false,
        }
    },
    methods: {
        getNewsDetails() {
            axios.get(`${APP_URL}/api/news/${this.newsSlug}`)
                .then(res => {
                    if (res.data.success) {
                        this.news = res.data.news;
                        this.isLoading = false;
                    }
                })
        }
    },
    created() {
        this.isLoading = true;
        this.newsSlug = this.$route.params.news;
        this.getNewsDetails();
    }
}
</script>

<style scoped>

</style>
