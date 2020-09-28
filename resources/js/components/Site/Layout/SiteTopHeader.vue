<template>
  <header class="header-area bg-white">
    <div class="header-top">
      <div class="header-top-nav text-center">
        <div class="row">
          <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3">
            <ul class="top-heading">
              <li>
                <a href="#">
                  <i class="fas fa-eye"></i>
                  <span>Certificeret webshop</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fas fa-check"></i>
                  <span>Nem og gennemskuelig handel</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fas fa-check"></i>
                  <span>Sikker betaling</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fas fa-check"></i>
                  <span>Køberbeskyttelse på op til 10.000 kr</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fas fa-check"></i>
                  <span>Sikker betaling</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="header-searcha-area bg-light">
      <div class="header_top">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-9">
              <div class="row">
                <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                  <!-- <router-link tag="a" to="/favourites" class="wishlist hide-desktop text-center">
                                        <img src="/images/icons/favorite.png" height="30" alt="favourites">
                  </router-link>-->
                  <div class="header-logo m-auto">
                    <h4>
                      <router-link to="/">
                        <img src="/frontend/assets/img/site.png" id="logo" alt="logo" />
                      </router-link>
                    </h4>
                  </div>
                  <!-- <div class="login text-center hide-desktop">
                    <div v-if="userLoggedIn">
                      <div class="user-login" @click="showUserMenuMobile = !showUserMenuMobile">
                        <i class="fas fa-user"></i>
                        <br />Profil
                      </div>
                      <div class="dropdown-menu wow bounceIn" v-if="showUserMenuMobile">
                        <router-link
                          tag="a"
                          class="dropdown-item"
                          :to="{name:'favourites'}"
                        >Favoritter</router-link>

                        <router-link
                          tag="a"
                          class="dropdown-item"
                          :to="{name:'customer-dashboard'}"
                        >Oversigt</router-link>
                        <router-link
                          tag="a"
                          class="dropdown-item"
                          :to="{name:'customer-profile'}"
                        >Profil</router-link>
                        <router-link
                          tag="a"
                          class="dropdown-item"
                          :to="{name:'customer-orders'}"
                        >Ordres</router-link>
                        <div class="dropdown-divider"></div>
                        <router-link class="dropdown-item" to="/logout">Log ud</router-link>
                      </div>
                    </div>
                    <div class="user-login" v-if="!userLoggedIn">
                      <router-link to="/login">
                        <i class="fas fa-sign-out-alt"></i>
                        <br />Log ind
                      </router-link>
                    </div>
                  </div>-->
                </div>
                <div class="col-md-6 col-lg-8 mt-4">
                  <div
                    class="main_search mt-0 mb-2"
                    style="border: 1px solid #ced4da;border-radius: 5px;"
                  >
                    <form @submit.prevent="searchFrom">
                      <div class="input-group">
                        <button type="button" class="btn btn-light rounded-0 pl-3 pr-3">
                          <i class="fas fa-search"></i>
                        </button>
                        <input
                          type="text"
                          v-model="search"
                          class="form-control rounded-0"
                          id="searchForm"
                          style="border: 1px solid transparent; !important"
                          placeholder="Søg her"
                          value
                        />
                        <span class="input-group-btn">
                          <button
                            type="submit"
                            class="btn btn-success rounded-0"
                            style="background-color: #078223;border-color:#078223"
                          >Søg</button>
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-lg-3 mt-3">
              <div class="header_top_button d-flex justify-content-center">
                <router-link tag="div" to="/favourites" class="wishlist favourite-box text-center">
                  <a href="#">
                    <div class="favorite-icon">
                      <img src="/images/icons/favorite.png" height="30" alt="favourite" />
                    </div>
                    <label class="favourite-badge">{{totalFavourites}}</label>
                  </a>
                </router-link>

                <router-link :to="{name:'cart'}" tag="div" class="ml-4 cart-box">
                  <!-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> -->
                  <div class="cart-icon">
                    <img src="/images/icons/cart.png" width="32" alt />
                    <label class="cart-badge">{{$store.state.cartCount}}</label>
                  </div>
                </router-link>

                <div class="login ml-4 text-center">
                  <div v-if="userLoggedIn">
                    <div
                      class="user-login"
                      v-on-clickaway="close"
                      @click="showUserMenu = !showUserMenu"
                    >
                      <img src="/images/icons/user.png" width="32" alt />
                    </div>
                    <div class="dropdown-menu wow bounceIn" v-if="showUserMenu">
                      <router-link
                        tag="a"
                        class="dropdown-item"
                        :to="{name:'favourites'}"
                      >Favoritter</router-link>

                      <router-link
                        tag="a"
                        class="dropdown-item"
                        :to="{name:'customer-dashboard'}"
                      >Oversigt</router-link>
                      <router-link
                        tag="a"
                        class="dropdown-item"
                        :to="{name:'customer-profile'}"
                      >Profil</router-link>
                      <router-link
                        tag="a"
                        class="dropdown-item"
                        :to="{name:'customer-orders'}"
                      >Ordrer</router-link>
                      <div class="dropdown-divider"></div>
                      <router-link class="dropdown-item" to="/logout">Log ud</router-link>
                    </div>
                  </div>
                  <div class="user-login" v-if="!userLoggedIn">
                    <router-link to="/login">
                      <img src="/images/icons/login.png" width="32" alt />
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- navbar area  -->
    <!--end of navbar area  -->
  </header>
</template>

<script>
import { mixin as clickaway } from "vue-clickaway";

export default {
  name: "SiteTopHeader",
  mixins: [clickaway],
  data() {
    return {
      showUserMenu: false,
      showUserMenuMobile: false,
      showUserFilterMobile: false,
      search: null,
      tempSearch: null,
      userLoggedIn: User.loggedIn(),
      userName: User.name(),
      totalFavourites: 0,
    };
  },
  methods: {
    getUserFavourites() {
      axios.get(`/api/user/total/favourites`).then((res) => {
        if (res.data.status == 200) {
          this.totalFavourites = res.data.totalFavourites;
        }
      });
    },
    searchFrom() {
      this.tempSearch = this.search.toLowerCase().trim();
      this.tempSearch = this.search.toLowerCase().trim().replace(" ", "-");
      this.search = null;
      if (this.tempSearch != null) {
        this.$router.push({
          name: "search-products",
          params: { search: this.tempSearch },
        });
      }
    },
    close() {
      this.showUserMenu = false;
    },
  },
  created() {
    this.getUserFavourites();
  },
  mounted() {
    this.$root.$on("updateFavouriteProductList", (dataReceived) => {
      this.getUserFavourites();
    });
  },
};
</script>

<style scoped>
.cart-box {
  cursor: pointer;
}

.top-heading {
  display: flex;
  justify-content: center;
  margin: 0px;
}

img#logo {
  width: 230px;
}
.justify-content-between {
  align-items: center;
}

.user-profile a:hover {
  text-decoration: none;
}

.user-profile,
.user-login {
  cursor: pointer !important;
  color: #ff7c3b !important;
}

.dropdown-menu {
  display: block !important;
  left: 50px;
  min-width: 180px;
}

.favourite-box {
  position: relative;
}

i.fa.fa-shopping-cart {
  font-size: 30px;
  color: #ff7c3b;
}

.color-theme {
  color: #ff7c3b;
}
.cart-icon,
.favorite-icon {
  position: relative;
}
label.cart-badge {
  position: absolute;
  right: -10px;
  top: 0;
  padding: 0px 5px;
  background: #19606f;
  border-radius: 100%;
  font-size: 12px;
  font-weight: bold;
  color: #ffffff;
}

label.favourite-badge {
  position: absolute;
  right: -10px;
  top: 0;
  padding: 0px 5px;
  background: #19606f;
  border-radius: 100%;
  font-size: 12px;
  font-weight: bold;
  color: #ffffff;
}
@media (max-width: 720px) {
  .dropdown-menu {
    display: block !important;
    right: 0;
    left: unset;
    width: 180px;
    top: 70px;
  }
}
</style>
