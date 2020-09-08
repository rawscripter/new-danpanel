<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <BlogSideBar @filterBlogByCategory="filterBlog"></BlogSideBar>
            </div>
            <div class="col-md-9">
                <loading
                    :color="'#00adf3'"
                    :active.sync="isLoading"
                    :can-cancel="true"
                    :loader="'dots'"
                    :is-full-page="false"
                ></loading>
                <div class="row" v-if="!isLoading">
                    <div class="col-md-4" v-for="blog in blogs" :key="blog.id">
                        <SingleBlogLayout :blog="blog"></SingleBlogLayout>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SingleBlogLayout from "../Layout/Blog/SingleBlogLayout";
import BlogSideBar from "../SideBar/BlogSideBar";

export default {
    name: "Blogs",
    components: {
        SingleBlogLayout,
        BlogSideBar
    },
    data() {
        return {
            blogs: [],
            tempBlogs: [],
            isLoading: false,
        };
    },
    methods: {
        filterBlog(id) {
            let tempBlogs = this.tempBlogs;
            let blogs = tempBlogs.filter(blog => {
                return blog.sub_category_id == id
            })
            this.blogs = blogs;
            // this.blogs = Object.keys(tempBlogs).filter(blog => blog.sub_category_id === id);
        },
        getBlogs() {
            if (this.$store.state.blogs.isStored) {
                this.blogs = this.$store.getters.getStoreBlogs;
                this.tempBlogs = this.$store.getters.getStoreBlogs;
                this.isLoading = false;
            } else {
                axios.get(`${APP_URL}/api/blogs`).then((res) => {
                    this.blogs = res.data.blogs;
                    this.tempBlogs = res.data.blogs;
                    this.isLoading = false;
                    this.$store.commit("saveBlogs", this.blogs);
                });
            }
        },
    },
    created() {
        this.isLoading = true;
        this.getBlogs();
    },
};
</script>

<style scoped>

</style>
