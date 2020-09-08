<template>
    <div class="container">

        <div class="row">
            <loading :active.sync="isLoading"
                     :is-full-page="false"></loading>
            <!--            <div class="col-md-3">-->
            <!--                <BlogSideBar></BlogSideBar>-->
            <!--            </div>-->
            <div class="col-md-9 m-auto" v-if="!isLoading">
                <div class="blog-area shadow">
                    <div class="blog-read-title customize-sub-category-header p-3"
                         style="color: white; font-size: 20px; background-color: rgb(0 172 242)">
                        {{ blog.title }}
                    </div>
                    <div class="row border ml-0 mr-0">
                        <div class="col-md-12 col-lg-12">
                            <div class="blog-read-img-comment" style="padding:2% 25%">
                                <div class="blog-read-img border">
                                    <img style="width: 100%; height:15rem;"
                                         :src='`/blog/images/${blog.image}`'
                                         :alt="blog.title">
                                </div>
                            </div>

                            <div class="blog-read-content-area border1 p-3">
                                <div class="blog-description" spellcheck="false" v-html="blog.description">

                                </div>

                                <div class="date_authore mt-3">
                                    <p>Skrevet af Anja
                                        in {{ blog.created_at }}</p>
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
import BlogSideBar from "../SideBar/BlogSideBar";

export default {

    name: "SingleBlogDetailsPage",
    components: {
        BlogSideBar
    },
    data() {
        return {
            blogSlug: null,
            blog: null,
            isLoading: false,
        }
    },
    methods: {
        getBlogDetails() {
            axios.get(`${APP_URL}/api/blog/${this.blogSlug}`)
                .then(res => {
                    if (res.data.success) {
                        this.blog = res.data.blog;
                        this.isLoading = false;
                    }
                })
        }
    },
    created() {
        this.isLoading = true;
        this.blogSlug = this.$route.params.blog;
        this.getBlogDetails();
    }
}
</script>

<style scoped>

</style>
