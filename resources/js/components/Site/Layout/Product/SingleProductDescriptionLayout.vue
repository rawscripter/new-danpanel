<template>
    <div class="product_view_description">
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
    name: "SingleProductDescriptionLayout",
    props: ["product"],
    components: {
        Carousel,
        Slide,
    },

    
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
