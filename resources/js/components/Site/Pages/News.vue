<template>
  <div>
    <div>
      <loading
        :color="'#00adf3'"
        :active.sync="isLoading"
        :can-cancel="false"
        :loader="'dots'"
        :is-full-page="false"
      ></loading>
    </div>
    <div class="container" v-if="!isLoading">
      <div class="row">
        <div class="col-md-4" v-for="news in newsList" :key="news.id">
          <SingleNewsLayout :news="news"></SingleNewsLayout>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SingleNewsLayout from "../Layout/News/SingleNewsLayout";

export default {
  name: "News",
  components: {
    SingleNewsLayout,
  },
  data() {
    return {
      newsList: [],
      isLoading: false,
    };
  },
  methods: {
    getNews() {
      if (this.$store.state.news.isStored) {
        this.newsList = this.$store.getters.getStoreNews;
        this.isLoading = false;
      } else {
        axios.get(`${APP_URL}/api/news`).then((res) => {
          this.newsList = res.data.newsList;
          this.isLoading = false;
          this.$store.commit("saveNews", this.newsList);
        });
      }
    },
  },
  created() {
    this.isLoading = true;
    this.getNews();
  },
};
</script>

<style scoped>
</style>
