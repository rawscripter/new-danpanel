<template>
    <div class="page-wrapper wow" id="product_area">
        <loading
            :color="'#00adf3'"
            :active.sync="isLoading"
            :can-cancel="false"
            :loader="'dots'"
            :is-full-page="false"
        ></loading>
        <div class="container no-padding-in-mobile">
            <div class="row">
                <div class="col-md-12 no-padding-in-mobile">
                    <!-- <HeaderVideoSection></HeaderVideoSection> -->
                    <div class="main-content">
                        <div class="product-area" v-if="requestProducts.length > 0">
                            <div class="package-products">
                                <div class="alert text-center mr-2 ml-2">
                                    <h4 class="m-0 p-0 custom-color">
                                        <strong>Hent Tilbud</strong>
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ml-0 pl-5 pr-5 mr-0 pr-0 padding-for-mobile">
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
                                            <slide v-for="product in requestProducts" :key="product.id">
                                                <SingleProduct :product="product"></SingleProduct>
                                                <!-- end of product single  -->
                                            </slide>
                                        </carousel>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <div class="product-area" v-if="packageProducts.length > 0">
                            <div class="package-products">
                                <div class="alert text-center mr-2 ml-2">
                                    <h4 class="m-0 p-0 custom-color">
                                        <strong>Pakketilbud</strong>
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ml-0 pl-5 pr-5 mr-0 pr-0 padding-for-mobile">
                                        <carousel
                                            :perPageCustom="[[320, 2],[480, 2],[768, 2],[1199,4]]"
                                            :navigationNextLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left'>`"
                                            :navigationPrevLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left rotate-180'>`"
                                            :paginationActiveColor="'#00adf3'"
                                            :autoplay-timeout="4000"
                                            :navigationEnabled="true"
                                            :loop="true"
                                            :autoplay="true"
                                            :per-page="3"
                                            :mouse-drag="true"
                                        >
                                            <slide v-for="product in packageProducts" :key="product.id">
                                                <SingleProduct :product="product"></SingleProduct>
                                                <!-- end of product single  -->
                                            </slide>
                                        </carousel>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-area" v-if="runningProducts.length > 0">
                            <div class="running-products">
                                <div class="alert text-center mr-2 ml-2">
                                    <h4 class="m-0 p-0 custom-color">
                                        <strong>Shop</strong>
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ml-0 pl-5 pr-5 mr-0 pr-0 padding-for-mobile">
                                        <carousel
                                            :perPageCustom="[[320, 2],[480, 2],[768, 2],[1199,4]]"
                                            :navigationNextLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left'>`"
                                            :navigationPrevLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left rotate-180'>`"
                                            :paginationActiveColor="'#00adf3'"
                                            :autoplay-timeout="4000"
                                            :navigationEnabled="true"
                                            :loop="true"
                                            :autoplay="true"
                                            :per-page="3"
                                            :mouse-drag="true"
                                        >
                                            <slide v-for="product in runningProducts" :key="product.id">
                                                <SingleProduct :product="product"></SingleProduct>
                                                <!-- end of product single  -->
                                            </slide>
                                        </carousel>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
	    <div class="cookie" style="position:sticky; top:auto; bottom:0; z-index:1; background:rgba(51, 51, 0, 0.6)">
            <img width="32px" src="/images/icons/Cookies-ikon-hvid.png" alt="cookies icon"> 
		<span>For at give
				dig den bedste oplevelse hos DanPanel anvender vi cookies. Ved at anvende DanPanels platform og klikke rundt
				på vores site accepterer du brugen af cookies. 
                <router-link to="/Privatlivspolitik-cookies">læs mere</router-link> 
                </span>
		<span class="text-right cookie-close-x ml-auto">x</span>
	    </div>

    </div>
	
       
</template>


<script>
import ProductFilter from "../SideBar/ProductFilter";
import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
import SingleProduct from "../Layout/Product/Loop/SingleProduct";
import HeaderVideoSection from "../Layout/HeaderVideoSection";
import {Carousel, Slide} from "vue-carousel";
export default {
    name: "SiteIndex",
    components: {
        ProductFilter,
        SubCategoryMenuBar,
        SingleProduct,
        HeaderVideoSection,
        Carousel,
        Slide,
    },
    data() {
        return {
            errorText: "Loader...",
            isLoading: false,
            products: [],
            runningProducts: [],
            packageProducts: [],
            requestProducts: [],
        };
    },
    methods: {
        eventHandler(data) {
            this.$router.push({
                name: "filter",
                query: {
                    gender: data.gender,
                    short: data.short,
                    minPrice: data.priceRange[0],
                    maxPrice: data.priceRange[1],
                },
            });
        },
        getPackageProducts() {
            if (this.$store.getters.isStoreLoaded) {
                this.packageProducts = this.$store.getters.getPackageProducts;
                this.isLoading = false;
            } else {
                axios.get(`${APP_URL}/api/package/products`).then((res) => {
                    this.packageProducts = res.data.products;
                    this.$store.commit("savePackageProducts", this.packageProducts);
                    this.isLoading = false;
                });
            }
        },
        getRunningProducts() {
            if (this.$store.getters.isStoreLoaded) {
                this.runningProducts = this.$store.getters.getShopProducts;
            } else {
                axios.get(`${APP_URL}/api/running/products`).then((res) => {
                    this.runningProducts = res.data.products;
                    this.$store.commit("saveShopProducts", this.runningProducts);
                });
            }
        },
        getRequestProducts() {
            if (this.$store.getters.isStoreLoaded) {
                this.requestProducts = this.$store.getters.getRequestProducts;
            } else {
                axios.get(`${APP_URL}/api/request/products`).then((res) => {
                    this.requestProducts = res.data.products;
                    this.$store.commit("saveRequestProducts", this.requestProducts);
                });
            }
        },
    },
    created() {
        this.isLoading = true;
        this.getPackageProducts();
        this.getRunningProducts();
        this.getRequestProducts();
    },
};
   
</script>

<style scoped>
.product-area {
    background: #fff;
    padding: 5px;
    /* height:auto; */
    /* min-height: 70vh; */
}
.big-error-font {
    font-size: 48px;
    color: #3939396b;
    margin-top: 150px !important;
}
.prodcut-signle {
    border: 1px solid #dadada8c;
}
.prodcut-signle:hover {
    box-shadow: 3px 6px 2px 0px #dadada8c;
    transition-duration: 0.5s;
}
.alert {
    background: #f2f2f2;
}
.custom-color {
    color: #19606f;
}

.cookie {
    position: absolute;
    top: 0;
    width: 100%;
}


.cookie-close-x {
    position: absolute;
    right: 15px;
    font-weight: bold;
    cursor: pointer;
}
</style>