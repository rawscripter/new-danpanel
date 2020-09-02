<template>
  <div class="container">
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
</template>

<script>
import SingleBlogLayout from "../Layout/Blog/SingleBlogLayout";

export default {
  name: "Blogs",
  components: {
    SingleBlogLayout,
  },
  data() {
    return {
      blogs: [],
      isLoading: false,
    };
  },
  methods: {
    getBlogs() {
      axios.get(`${APP_URL}/api/blogs`).then((res) => {
        this.blogs = res.data.blogs;
        this.isLoading = false;
      });
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
