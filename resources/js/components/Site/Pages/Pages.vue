<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <PagesSideBar></PagesSideBar>
      </div>
      <div class="col-md-9">
        <SinglePageDetailsPage></SinglePageDetailsPage>
      </div>
    </div>
  </div>
</template>

<script>
import PagesSideBar from "../SideBar/PagesSideBar.vue";
import SinglePageDetailsPage from "./SinglePageDetailsPage.vue";
export default {
  name: "Pages",
  components: {
    SinglePageDetailsPage,
    PagesSideBar,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style scoped>
</style>
