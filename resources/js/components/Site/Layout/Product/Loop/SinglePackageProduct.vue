<template>

    <router-link
        :to="{name: 'product-details', params:{slug:product.slug}}"
    >
        <div class="single-package-product mb-3">
            <carousel
                :perPageCustom="[[320, 1],[480, 1],[768, 1],[1199,1]]"
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
                <slide v-for="(image,index) in product.productSlideImages" :key="index">
                    <img
                        :src="image.fullImage"
                        @click="changeMainImage(index)"
                        :class="{active : active_img === index}"
                        class="show-small-img"
                        alt
                    />
                </slide>
            </carousel>

        </div>
    </router-link>
</template>

<script>
import {Carousel, Slide} from "vue-carousel";

export default {
    name: "SinglePackageProduct",
    props: ["product"],
    components: {
        Carousel,
        Slide,
    },
    data() {
        return {
            showModal: false,
            isUserLiked: false,
            isUserFavourite: false,
            isUserLogin: User.loggedIn(),
            totalLikes: 0,
            active_img: null
        };
    },
    methods: {
        changeMainImage(index) {
            this.active_img = index;
            this.displayProductImage = this.product.productImages[index].featureImage;
        },
    }

};
</script>

<style scoped>
.VueCarousel-slide {
    text-align: center !important;
}

.VueCarousel-slide {
    max-height: 550px;
}

.VueCarousel-slide img.show-small-img {
    width: 100% !important;
}
</style>
