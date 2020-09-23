<template>
  <div class="page-wrapper" style="background: #ffffff; margin-top:20px;">
    <div class="container">
      <loading
        :color="'#00adf3'"
        :active.sync="isLoading"
        :can-cancel="false"
        :loader="'dots'"
        :is-full-page="false"
      ></loading>

      <div class="row" v-if="!isLoading">
        <div class="col-md-8 col-lg-8 wow bounceInUp mt-50">
          <SingleProductDetailsLayout :product="product"></SingleProductDetailsLayout>
        </div>
        <div class="col-md-4 col-lg-4 wow bounceInLeft mt-50" v-if="!product.is_request_product">
          <ProductOfferInfoSidebar :product="product"></ProductOfferInfoSidebar>
        </div>
        <div v-else class="col-md-4 col-lg-4 wow bounceInLeft mt-50">
          <ProductRequestFormSidebar :product="product"></ProductRequestFormSidebar>
        </div>
        <!-- <div class="col-md-4 col-lg-3 wow bounceInRight">
                    <RelatedProductsSidebar :products="relatedProducts"></RelatedProductsSidebar>
        </div>-->
      </div>

      <div class="row" v-if="!isLoading">
        <div class="col-md-12 mt-30">
          <h3 class="bg-secondary align-center p-3">Relevante produkter:</h3>
        </div>

        <div class="col-md-12 col-lg-12 wow bounceInRight">
          <RelatedProductsSidebar :products="relatedProducts"></RelatedProductsSidebar>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProductOfferInfoSidebar from "../SideBar/ProductOfferInfoSidebar";
import RelatedProductsSidebar from "../SideBar/RelatedProductsSidebar";
import SingleProductDetailsLayout from "../Layout/Product/SingleProductDetailsLayout";
import ProductRequestFormSidebar from "../SideBar/ProductRequestFormSidebar";

export default {
  name: "ProductDetailsPage",
  components: {
    ProductOfferInfoSidebar,
    RelatedProductsSidebar,
    SingleProductDetailsLayout,
    ProductRequestFormSidebar,
  },
  data() {
    return {
      isLoading: false,
      fullPage: true,
      productSlug: null,
      product: null,
      relatedProducts: [],
    };
  },

  methods: {
    getProduct(slug) {
      axios
        .get(`${APP_URL}/api/product/${slug}`)
        .then((res) => {
          this.isLoading = false;
          this.product = res.data.product;
          document.title = this.product.name;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getRelatedProducts(slug) {
      axios
        .get(`${APP_URL}/api/product/${slug}/related-products`)
        .then((res) => {
          this.relatedProducts = res.data.relatedProducts;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  created() {
    this.isLoading = true;
    this.getProduct(this.$route.params.slug);
    this.getRelatedProducts(this.$route.params.slug);
    document.body.scrollTop = document.documentElement.scrollTop = 0;
  },
};
</script>

<style scoped>
.bg-secondary {
  background-color: #eaeaea !important;
  font-weight: bold;
  font-size: 20px;
}
</style>
