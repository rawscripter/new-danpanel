<template>
  <div class="page">
    <loading :active.sync="isLoading" :is-full-page="false"></loading>
    <div v-if="!isLoading">
      <div class="page-read-img-comment" v-if="page.image != ''">
        <div class="page-read-img border mt-3">
          <img
            style="width: 100%; height: 100%; object-fit: cover"
            :src="`/images/${page.image}`"
            :alt="page.title"
          />
        </div>
      </div>

      <div class="page-read-content-area border1 p-3">
        <div
          class="page-description"
          spellcheck="false"
          v-html="page.content"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SinglePageDetailsPage",

  data() {
    return {
      pageSlug: this.$route.params.page,
      page: null,
      isLoading: false,
    };
  },
  methods: {
    getPageDetails() {
      axios.get(`${APP_URL}/api/page/${this.pageSlug}`).then((res) => {
        if (res.data.success) {
          this.page = res.data.page;
          this.isLoading = false;
        }
      });
    },
  },
  created() {
    this.isLoading = true;
    this.getPageDetails();
  },
};
</script>

<style scoped>
</style>
