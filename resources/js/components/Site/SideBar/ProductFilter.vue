<template>
    <div
        v-if="!isLoading"
        :class="showFilterMenuOnMobile ? 'show-filter-on-mobile' : '' "
        class="main-sidebar mt-2 shadow"
        id="main_sidebar"
    >
        <!--        <div class="m-auto text-center mb-5">-->
        <!--            <toggle-button-->
        <!--                v-model="selected_channel"-->
        <!--                :width="90"-->
        <!--                :height="30"-->
        <!--                :font-size="12"-->
        <!--                :color="{-->
        <!--                           checked: '#00adf3',unchecked: '#13b017',-->
        <!--                       }"-->
        <!--                :labels="{checked: 'Private', unchecked: 'Business'}"-->
        <!--                @change="onChangeEventHandler"/>-->
        <!--        </div>-->

        <div class="filter-title text-center">
            <h5>
                <strong>Filter</strong>
            </h5>
        </div>

        <div
            @click="showFilterMenuOnMobile = !showFilterMenuOnMobile"
            class="sidebar-header hide-desktop d-flex justify-content-between"
        >
            <i class="fas fa-times mt-2" id="closeMobileSidebar"></i>
        </div>
        <form>
            <!--      <div class="till_filter">-->
            <!--        <h5>-->
            <!--          <b>Til :</b>-->
            <!--        </h5>-->
            <!--        &lt;!&ndash; checkbox single  &ndash;&gt;-->
            <!--        <label class="checkbox_container">-->
            <!--          Alle-->
            <!--          <input v-model="filter.gender" value="All" type="radio" />-->
            <!--          <span class="checkmark"></span>-->
            <!--        </label>-->
            <!--        &lt;!&ndash; end of checkbox single  &ndash;&gt;-->
            <!--        &lt;!&ndash; checkbox single  &ndash;&gt;-->
            <!--        <label class="checkbox_container">-->
            <!--          Mænd-->
            <!--          <input v-model="filter.gender" value="Men" type="radio" />-->
            <!--          <span class="checkmark"></span>-->
            <!--        </label>-->
            <!--        &lt;!&ndash; end of checkbox single  &ndash;&gt;-->
            <!--        &lt;!&ndash; checkbox single  &ndash;&gt;-->
            <!--        <label class="checkbox_container">-->
            <!--          Kvinder-->
            <!--          <input v-model="filter.gender" value="Women" type="radio" />-->
            <!--          <span class="checkmark"></span>-->
            <!--        </label>-->
            <!--        &lt;!&ndash; end of checkbox single  &ndash;&gt;-->
            <!--        &lt;!&ndash; checkbox single  &ndash;&gt;-->
            <!--        <label class="checkbox_container">-->
            <!--          Børn-->
            <!--          <input v-model="filter.gender" value="kids" type="radio" />-->
            <!--          <span class="checkmark"></span>-->
            <!--        </label>-->
            <!--        &lt;!&ndash; end of checkbox single  &ndash;&gt;-->
            <!--      </div>-->
            <div class="shoter_filter mt-3">
                <!--        <h5>-->
                <!--          <b>Shorter efter</b>-->
                <!--        </h5>-->
                <label class="checkbox_container">
                    Ny
                    <input v-model="filter.short" value="new" type="radio"/>
                    <span class="checkmark"></span>
                </label>

                <label class="checkbox_container">
                    Populær
                    <input v-model="filter.short" value="popular" type="radio"/>
                    <span class="checkmark"></span>
                </label>

                <label class="checkbox_container">
                    Tilbud
                    <input v-model="filter.short" value="discount" type="radio"/>
                    <span class="checkmark"></span>
                </label>

                <!-- end of checkbox single  -->
            </div>
            <div class="price_filter">
                <br/>
                <vue-slider :max="max" v-model="range"></vue-slider>

                <div class="price-range-text mt-2">
                    <input type="number" v-model="range[0]"/>
                    -
                    <input type="number" max v-model="range[1]"/>
                </div>
            </div>
            <br/>
            <div class="submit">
                <input type="button" @click="signalChange" value="Filtrer" class="btn btn-block btn-theme"/>
            </div>
            <br/>
            <p class="small reset-btn text-center" @click="resetFilter">Nulstil filter</p>
        </form>
    </div>
</template>

<script>
import VueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";
// import {ToggleButton} from 'vue-js-toggle-button'

export default {
    name: "ProductFilter",
    components: {
        VueSlider,
        // ToggleButton
    },
    props: ["callResetFilterFunction"],
    data() {
        return {
            // selected_channel: true,
            isLoading: false,
            showFilterMenuOnMobile: false,
            min: 0,
            max: 0,
            range: [0, 0],
            filter: {
                // gender: "All",
                short: "new",
                priceRange: null,
            },
        };
    },
    created() {
        this.isLoading = true;
        this.getMaxProductPrice();
        // let previous_selected_channel = this.$cookies.get(`product-channel`);
        // this.selected_channel = previous_selected_channel !== 'business';
    },
    methods: {
        onChangeEventHandler() {
            // alert(this.selected_channel
            let channel = this.selected_channel ? "private" : "business";
            this.$cookies.set(`product-channel`, channel, 6000 * 5);
            window.location.reload();
        },
        resetFilter() {
            this.getMaxProductPrice();

            // this.filter.gender = "All";
            this.filter.short = "new";
            this.filter.priceRange = null;
            this.signalChange();
        },
        signalChange() {
            this.filter.priceRange = this.range;
            this.$emit("filterProduct", this.filter);
        },
        getMaxProductPrice() {
            if (this.$store.state.filterMaxRange.isLoaded) {
                let range = this.$store.getters.getFilterMaxRange;
                this.max = range;
                this.range[1] = range;
                this.isLoading = false;
            } else {
                axios.get(`${APP_URL}/api/max/product/price`).then((res) => {
                    this.max = res.data.max;
                    this.range[1] = res.data.max;
                    this.isLoading = false;
                    this.$store.commit("saveFilterMaxRange", this.max);
                });
            }
        },
    },
    watch: {
        callResetFilterFunction(val) {
            if (val) {
                this.resetFilter();
                this.$emit("filterFromResetCompleted");
            }
        },
    },
    mounted() {
        this.$root.$on("showFilterMenuOnMobile", (dataReceived) => {
            this.showFilterMenuOnMobile = dataReceived;
        });
    },
};
</script>

<style>
.filterSticky {
    position: sticky;
    top: 150px;
    cursor: pointer;
    z-index: 11;
    pointer-events: all;
}

.price-range-text {
    text-align: center;
    font-weight: bold;
    color: #1eaae1;
    font-size: 20px;
    z-index: 10;
}

.reset-btn {
    cursor: pointer;
}

.vue-slider-process {
    background-color: #1eaae1 !important;
    border-radius: 15px;
}

.vue-slider-dot-tooltip-inner {
    border-color: #1eaae1 !important;
    background-color: #1eaae1 !important;
}

input[type="number"] {
    width: 100px;
    text-align: center;
    /* border-color: #aaaaaa; */
    border: 1px solid #eaeaea;
    padding: 5px 10px;
    font-size: 16px;
    color: #858585;
    border-radius: 4px;
}

.show-filter-on-mobile {
    transform: translate(0px) !important;
}

#closeMobileSidebar {
    padding-right: 10px;
    position: absolute;
    right: 0;
    top: 18px;
}

div#main_sidebar {
    min-width: 280px;
    max-width: 300px;
}

@media (max-width: 900px) {
    div#main_sidebar {
        z-index: 99999 !important;
    }

    .main-sidebar {
        transform: translate(-306px);
    }
}
</style>
