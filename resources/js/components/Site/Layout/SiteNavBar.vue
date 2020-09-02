<template>
  <div class="header_menu">
    <nav class="navbar navbar-expand-lg navbar-light" style="background:#fff">
      <div class="container">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="channel-toggle-button">
          <toggle-button
            v-model="selected_channel"
            :width="90"
            :height="30"
            :font-size="12"
            :color="{
                           checked: '#00adf3',unchecked: '#13b017',
                       }"
            :labels="{checked: 'Private', unchecked: 'Business'}"
            @change="onChangeEventHandler"
          />

          <button class="navbar-toggler" @click="showFilterOnMobile" type="button" id="openSidebar">
            <img src="/images/icons/filter.png" width="24" alt />
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto text-center">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Hjem</router-link>
            </li>

            <li class="nav-item" v-for="category in categories" :key="category.id">
              <router-link
                :to="{name:'category-product',params:{category:category.slug}}"
                class="nav-link"
              >
                <img
                  v-if="category.icon"
                  :src="`/images/icons/${category.icon}`"
                  width="24"
                  alt="ICON"
                />
                {{ category.name }}
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/about-us" class="nav-link">About Us</router-link>
            </li>

            <li class="nav-item">
              <router-link to="/blogs" class="nav-link">Blogs</router-link>
            </li>

            <li class="nav-item">
              <router-link to="/news-list" class="nav-link">News</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import ProductFilter from "../SideBar/ProductFilter";
import { ToggleButton } from "vue-js-toggle-button";
import VueSlider from "vue-slider-component";

export default {
  name: "SiteNavBar",
  components: {
    ToggleButton,
  },
  data() {
    return {
      filterMenu: false,
      categories: [],
      selected_channel: true,
    };
  },
  methods: {
    onChangeEventHandler() {
      // alert(this.selected_channel
      let channel = this.selected_channel ? "private" : "business";
      this.$cookies.set(`product-channel`, channel, 6000 * 5);
      window.location.reload();
    },
    getCategories() {
      axios
        .get(`${APP_URL}/api/categories`)
        .then((res) => {
          this.categories = res.data.categories;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    showFilterOnMobile() {
      this.$root.$emit("showFilterMenuOnMobile", !this.filterMenu);
    },
  },
  created() {
    this.getCategories();
    let previous_selected_channel = this.$cookies.get(`product-channel`);
    this.selected_channel = previous_selected_channel !== "business";
  },
};
</script>

<style scoped>
a.nav-link.router-link-exact-active.router-link-active {
  color: rgb(0 173 243);
}

nav {
  box-shadow: unset;
}

.header_menu {
  margin-top: -2px;
}
</style>
