<template>
  <div class="blog-single shadow p-0 mb-5" style="height: unset">
    <img
      class="blog-image"
      alt="blog image"
      :src="`/blog/images/${blog.image}`"
      style="width: 100%; height: 200px; object-fit: cover"
    />
    <div class="p-3">
      <router-link
        :to="{ name: 'blog-details', params: { blog: blog.slug } }"
        tag="span"
        style="height: 3rem"
        class="cursour-pointer"
      >
        <div class="blog-title">{{ blog.title }}</div>
      </router-link>

      <div
        class="blog-content"
        v-html="blog.short_des"
        style="height: 5rem; margin-top: 2rem"
      ></div>

      <div class="blog-button mt-5 lasmere">
        <router-link
          :to="{ name: 'blog-details', params: { blog: blog.slug } }"
          class="btn btn-theme btn-block"
          >Læs mere
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleBlogLayout",
  props: ["blog"],
};
</script>

<style scoped>
.blog-image {
  width: 12rem;
  height: 10rem;
}

.blog-title {
  font-size: 20px;
  text-align: center;
  margin: 0px;
  height: 4rem;
  margin-top: 20px !important;
}

.blog-content {
  margin-top: 22px;
  text-align: center;
  height: 5rem;
  overflow: hidden;
}

.blog-single.shadow {
  text-align: center;
}

/* img.blog-image {
    max-height: 245px;
} */

.cursour-pointer {
  cursor: pointer;
}
</style>
