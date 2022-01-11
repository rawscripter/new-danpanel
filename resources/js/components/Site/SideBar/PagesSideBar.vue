<template>
  <div>
    <div class="card border-0" v-if="!isLoading">
      <div class="card-body shadow border-0">
        <div
          class="sub-category-title p-2"
          v-for="page in pages"
          :key="page.id"
          @click="getPage(page.slug)"
        >
          {{ page.title }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PagesSideBar",
  data() {
    return {
      pages: [],
      isLoading: false,
    };
  },
  methods: {
    getPage(slug) {
      this.$router.push({ name: "page", params: { page: slug } });
    },
    getPages() {
      axios.get(`${APP_URL}/api/get/pages`).then((res) => {
        this.pages = res.data.pages;
        this.isLoading = false;
      });
    },
  },
  created() {
    this.getPages();
  },
};
</script>

<style scoped>
.sub-category-title {
  color: #7b7b7b;
  font-weight: bold;
  cursor: pointer;
}

.sub-category-title:hover {
  text-decoration: underline;
}
</style>
