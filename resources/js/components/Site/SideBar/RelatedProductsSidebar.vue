<template>
  <div class="product_view_right_widget">
    <div class="related-prodcut-widget">
      <div class="row">
        <div class="col-12">
          <carousel
            :perPageCustom="[[320, 2],[480, 2],[768, 2],[1199,4]]"
            :paginationActiveColor="'#00adf3'"
            :autoplay-timeout="4000"
            :navigationNextLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left'>`"
            :navigationPrevLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left rotate-180'>`"
            :navigationEnabled="true"
            :loop="true"
            :autoplay="true"
            :per-page="3"
            :mouse-drag="true"
          >
            <slide v-for="product in products" :key="product.id">
              <SingleProduct :product="product"></SingleProduct>
              <!-- end of product single  -->
            </slide>
          </carousel>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";

import SingleProduct from "../Layout/Product/Loop/SingleProduct";

export default {
  name: "RelatedProductsSidebar",
  components: {
    SingleProduct,
    Carousel,
    Slide,
  },
  props: ["products"],
  data() {
    return {};
  },
};
</script>

<style scoped>
</style>
