<template>
    <div class="product_view_main">
        <!-- Primary carousel image -->

        <div class="show full-product-image">
            <img
                v-if="hasImages"
                @click="previousSliderImage"
                src="/images/icons/next-icon.png"
                class="icon-left"
                alt
                id="prev-img"
            />

            <div class="full-image">
                <img
                    :src="displayProductImage"
                    id="mainImage"
                    alt="Product Image"
                    style="display:block; width:80%; height:80%; margin:auto;"
                />
                <span
                    class="favourite-badge"
                    @click="removeProductToFavouriteList(product.slug)"
                    v-if="isUserFavourite"
                >favoritter</span>
            </div>
            <img
                v-if="hasImages"
                @click="nextSliderImage"
                src="/images/icons/next-icon.png"
                class="icon-right"
                alt
                id="next-img"
            />


        </div>

        <!-- Secondary carousel image thumbnail gallery -->
        <div v-if="hasImages" class="small-img">
            <div class="image-container">
                <!-- <img
                  v-for="(image,index) in product.productImages"
                  :key="index"
                  :src="image.thumbImage"
                  @click="changeMainImage(index)"
                  :class="{active : active_img === index}"
                  class="show-small-img"
                  alt
                />-->

                <carousel
                    :perPageCustom="[[320, 4],[480, 4],[768, 4],[1199,6]]"
                    :paginationActiveColor="'#00adf3'"
                    :autoplay-timeout="4000"
                    :navigationNextLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left rotate'>`"
                    :navigationPrevLabel="`<img src='/images/icons/next-icon.png' width='16px' class='icon-left rotate-180'>`"
                    :navigationEnabled="true"
                    :loop="true"
                    :autoplay="true"
                    :per-page="3"
                    :mouse-drag="true"
                >
                    <slide v-for="(image,index) in product.productImages" :key="index">
                        <img
                            :src="image.thumbImage"
                            @click="changeMainImage(index)"
                            :class="{active : active_img === index}"
                            class="show-small-img"
                            alt
                        />
                    </slide>
                </carousel>
            </div>
        </div>

        <div class="timer text-center mt-2 mb-2" v-if="product.is_offer_expirable">
            <vac v-if="product.is_offer_expirable" :end-time="new Date(product.expire_date)">
                <div
                    class="timer-area d-flex justify-content-center mt-3 mb-3"
                    slot="process"
                    slot-scope="{ timeObj }"
                >
                    <div class="clock">
                        <div class="well top-pane">
                            <div id="days-text" class="text">Dage</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="days" class="num">{{ timeObj.d }}</div>
                        </div>
                    </div>

                    <div class="clock">
                        <div class="well top-pane">
                            <div id="hours-text" class="text">Timer</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="hours" class="num">{{ timeObj.h }}</div>
                        </div>
                    </div>
                    <div class="clock">
                        <div class="well top-pane">
                            <div id="mins-text" class="text">Min</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="mins" class="num">{{ timeObj.m }}</div>
                        </div>
                    </div>

                    <div class="clock">
                        <div class="well top-pane">
                            <div id="secs-text" class="text">Sek</div>
                        </div>
                        <div class="well bottom-pane">
                            <div id="secs" class="num">{{ timeObj.s }}</div>
                        </div>
                    </div>
                </div>
                <span slot="finish" class="expired">Tilbuddet er udløbet</span>
            </vac>
            <span v-else class="expired">Kommer snart</span>
        </div>

        <h3 class="title mt-2 text-center">{{ product.name }}</h3>
        <!-- discription div  -->
        <div class="discription" v-html="product.full_des"></div>
        <br/>
        <!-- <h5 class="mt-2">
            <strong>Ordrenotat:</strong>
        </h5> -->
        <div class="orderNote" v-html="product.order_note"></div>
    </div>
</template>

<script>
import {Carousel, Slide} from "vue-carousel";

export default {
    name: "SingleProductDetailsLayout",
    props: ["product"],
    components: {
        Carousel,
        Slide,
    },

    data() {
        return {
            displayProductImage: this.product.featureImage,
            active_img: null,
            isUserFavourite: false,

        };
    },
    methods: {
        removeProductToFavouriteList(slug) {
            axios
                .get(`/api/product/${slug}/favourite/remove`)
                .then((res) => {
                    if (res.data.status === 200) {
                        this.isUserFavourite = false;
                        this.$toast.warning("Produkt fjernet fra favoritlisten.");
                        this.$root.$emit("updateFavouriteProductList", true);
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => console.log(err));
        },

        changeMainImage(index) {
            this.active_img = index;
            this.displayProductImage = this.product.productImages[index].featureImage;
        },
        nextSliderImage() {
            if (this.product.productImages.length > this.active_img + 1) {
                this.active_img++;
            } else {
                this.active_img = 0;
            }
            this.displayProductImage = this.product.productImages[
                this.active_img
                ].featureImage;
        },
        previousSliderImage() {
            if (this.active_img === 0 || this.active_img == null) {
                this.active_img = this.product.productImages.length - 1;
            } else {
                this.active_img--;
            }
            this.displayProductImage = this.product.productImages[
                this.active_img
                ].featureImage;
        },
    },
    computed: {
        hasImages() {
            return this.product.productImages.length > 0;
        },
    },
    mounted() {
        this.isUserFavourite = this.product.isFavouriteByCurrentUser;

    }
};
</script>

<style scoped>
img#mainImage {
    max-width: 100%;
}

.clock {
    width: 65px;
}

.bottom-pane {
    background-color: rgb(128, 255, 191) !important;
    border-color: rgb(0, 179, 89) !important;
    background-image: linear-gradient(to right, #00994d, #006633);
    color: #fff !important;
}

.num {
    font-size: 25px;
    color: #fff;
    font-weight: bold;
}

span.expired {
    font-weight: bold;
    font-size: 30px;
    text-align: center;
    margin: 50px !important;
    color: #ff2525;
}

.image-container img {
    max-width: 65px;
    margin-right: 10px;
    cursor: pointer;
}

/* .image-container {
  display: flex;
  justify-content: start;
} */

.discription {
    white-space: pre-wrap;
}

img.show-small-img.active {
    border: 2px solid #ff500d;
}

img#prev-img {
    position: absolute;
    top: 50%;
    left: 50px;
    transform: translate(0, -50%) rotate(180deg);
    cursor: pointer;
}

img#next-img {
    position: absolute;
    top: 50%;
    right: 50px;
    transform: translate(0, -50%);
    cursor: pointer;
}

@media (max-width: 800px) {
    img#prev-img {
        left: 0;
    }

    img#next-img {
        right: 0;
    }
}

.full-product-image {
    position: relative;
}

.VueCarousel-dot-container {
    margin: 0px !important;
}

img.icon-left.rotate {
    transform: rotate(0deg);
}


span.favourite-badge {
    position: absolute;
    right: 20%;
    background: #21a9df;
    cursor: pointer;
    padding: 1px 10px;
    font-weight: bold;
    color: #fff;
    letter-spacing: 1px;
    font-size: 12px;
    top: 16px;
}


.full-image {
    position: relative;
}
</style>
