<template>
    <div class="container product_view_sidebar shadow">
        <div class="pricing-left row">
                <div class="col-md-12" v-if="product.market_price> 0">
                    <!-- <h6>Gennemsnitlig markedspris</h6> -->
                    <h5>
                        <del>{{ product.market_price }} Kr</del>
                    </h5>
                </div>
                <!-- <h6>Startpris</h6> -->
                <div class="col-md-12"><h5>{{ product.offer_price }} Kr</h5>
                </div>
        <!-- <h6>
            <h5>{{ product.offer_price }} Kr</h5>
        </h6>  -->

        <!--            total save-->
        </div>  
        <div class="row">
            <div class="product-variations mb-3 col-md-12" v-if="product.product_variation.length > 0">
                <div v-for="variation in product.product_variation" :key="variation.id" class="pt-2 pb-2">
                    <div>
                        <strong>{{ variation.name }}:</strong>
                    </div>
                    <div class="variations">
                        <div class="variation" v-for="option in variation.options" :key="option.id">
                            <input
                                class="hidden radio-label"
                                :id="`radio-btn-${option.id}`"
                                type="radio"
                                :value="option.id"
                                :name="`variationOption[${variation.id}]`"
                                :checked="isOptionAlreadySelected(option.id)"
                            />
                            <label
                                @click="
                                    changeProductPriceOnVariationChange(
                                        variation.id,
                                        option.id,
                                        option.price,
                                        option.name
                                    )
                                "
                                class="button-label"
                                :for="`radio-btn-${option.id}`"
                            >
                <span>
                {{ option.name }}
                <span v-if="option.price > 0">+{{ option.price }}kr</span>
                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="love-section clearfix col-md-12 col-sm-3">
                <button v-if="product.isLikedByCurrentUser" class="btn btn-success">
                    {{ product.totalLikes }}
                    <i class="fas fa-heart" style="color:red"></i>
                </button>
                
                <button v-else @click="addProductToLikeList(product.slug)" class="btn btn-success">
                    {{ product.totalLikes }}
                    <i class="far fa-heart"></i>
                </button>
            </div>
            <div class="col-md-12 col-sm-3">
                <button class="btn btn-success">Du sparer {{ product.saving_percentage }}%</button>
            </div>

            <div class="col-md-12 col-sm-6"> 
                <button class="btn btn-theme btn-block col-md-12 col-sm-6" @click="addToCart(product)">Tilføj til kurv </button>
            </div>
        </div>
        <div class="sidebar-action row">
            <div class="col-12 col-sm-4">
                <p @click="addProductToFavouriteList(product.slug)" v-if="!isUserFavourite">
                    <img src="/images/icons/favorite.png" height="20" alt/> Gem
                    till favoritter
                </p>
            </div>
            <!-- <br/> -->
            <div class="col-12 col-sm-4">
                <p @click="addProductToReminderList(product.slug)">
                    <i class="fas fa-sync mr-2"></i> Påmind mig
                </p>
                <!-- <br/> -->
            </div>
            <div class="col-12 col-sm-2">
                <p @click="shareProductOnSocialMedia">
                    <img src="/images/icons/share.png" height="20" width="20" alt/>
                    Del produkt
                </p>
            </div>
        </div>
            <div class="sidebar-social mt-2 d-flex justify-content-around"></div>
            <div v-if="productRequestModal"
                class="modal fade bd-example-modal-sm show"
                tabindex="-1"
                role="dialog"
                aria-labelledby="mySmallModalLabel"
                :class="productRequestModal ? 'active' : ''"
                style="padding-right: 17px;">
                <div class="modal-dialog" style="margin-top: 250px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productRequestModal">Indsend tilbudsanmodning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span @click="productRequestModal = false" aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitProductRequest">
                                <div class="form-group">
                                    <label for="product">E-mail:</label>
                                    <input
                                        type="email"
                                        required
                                        v-model="productRequest.email"
                                        class="form-control"
                                        id="product"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="note">Bemærk:</label>
                                    <textarea
                                        v-model="productRequest.note"
                                        class="form-control"
                                        id="note"
                                        cols="10"
                                        rows="5"
                                    ></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-theme btn-block">Indsend anmodning</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: "ProductOfferInfoSidebar",
    props: ["product"],
    data() {
        return {
            selectedVariations: [],
            showModal: false,
            productRequestModal: false,
            isUserLiked: false,
            isUserFavourite: false,
            totalLikes: 0,
            isUserLogin: User.loggedIn(),
            productRequest: {
                email: null,
                note: null,
                type: "expired",
            },
        };
    },
    methods: {
        isOptionAlreadySelected(optionID) {
            return this.selectedVariations.find((x) => x.optionID === optionID);
            // return selectedIndex !== -1;
        },
        addToCart(item) {
            // console.log(item)

            // check if product has variation and user selected the variation

            let totalVariationsOfProduct = this.product.product_variation.length;
            if (totalVariationsOfProduct > 0) {
                if (totalVariationsOfProduct !== this.selectedVariations.length) {
                    this.$toast.error("Vælg først produktvariation");

                    return;
                } else {
                    Vue.set(item, "variations", this.selectedVariations);
                }
            }
            let randomUuid = Math.floor(Math.random() * 99999) + 999;

            Vue.set(item, "uuid", randomUuid);

            this.$store.commit("addToCart", item);
            this.$store.commit("saveCart");
            this.selectedVariations = [];
            this.$toast.success("Produktet er tilføjet til indkøbskurv");

        },
        shareProductOnSocialMedia() {
            this.$root.$emit("shareProduct", this.product);
        },
        changeProductPriceOnVariationChange(
            variationID,
            optionID,
            price,
            optionName
        ) {
            let selectedIndex = this.selectedVariations.findIndex(
                (x) => x.variationID === variationID
            );

            // already selected
            if (selectedIndex !== -1) {
                if (this.selectedVariations[selectedIndex].optionID === optionID)
                    return;

                let optionVariationOptionId = this.selectedVariations[selectedIndex]
                    .optionID;

                let productVariations = this.product.product_variation[selectedIndex];
                let optionVariationOptionIndex = productVariations.options.findIndex(
                    (x) => x.id === parseInt(optionVariationOptionId)
                );

                let optionVariationOption =
                    productVariations.options[optionVariationOptionIndex];

                //let newPrice = ((this.product.join_payment_percentage / 100) * price);

                this.product.offer_price -= optionVariationOption.price;

                this.selectedVariations[selectedIndex].optionID = optionID;
                this.selectedVariations[selectedIndex].optionName = optionName;
            } else {
                let newObject = {
                    variationID: variationID,
                    optionID: optionID,
                    optionName: optionName,
                };
                this.selectedVariations.push(newObject);
            }

            //   this.$cookies.set(
            //     `product-variation-${this.product.id}`,
            //     JSON.stringify(this.selectedVariations),
            //     60 * 5
            //   );

            this.product.offer_price += price;
        },
        submitProductRequest() {
            axios
                .post(
                    `/api/product/${this.product.slug}/make/request`,
                    this.productRequest
                )
                .then((res) => {
                    if (res.data.status === 200) {
                        this.productRequestModal = false;
                        Alert.showSuccessAlert(res.data.message);
                        this.productRequest.email = null;
                        this.productRequest.note = null;
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => console.log(err));
        },
        addProductToLikeList(slug) {
            axios
                .get(`/api/product/${slug}/like/add`)
                .then((res) => {
                    if (res.data.status === 200) {
                        this.isUserLiked = res.data.product.isLikedByCurrentUser;
                        this.totalLikes++;
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => console.log(err));
        },
        addProductToFavouriteList(slug) {
            if (!this.isUserLogin) {
                // this.$root.$emit("callProductRequestModal", this.product);
                this.$toast.error("Log ind først.");

                return;
            }
            axios
                .get(`/api/product/${slug}/favourite/add`)
                .then((res) => {
                    if (res.data.status === 200) {
                        this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                        Alert.showSuccessAlert("Produktet er tilføjet til favoritlisten.");
                        this.$root.$emit("updateFavouriteProductList", true);
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => console.log(err));
        },
        addProductToReminderList(slug) {
            axios
                .get(`/api/product/${slug}/reminder/add`)
                .then((res) => {
                    if (res.data.status === 200) {
                        Alert.showSuccessAlert("Produktet er tilføjet til påmindelsesliste.");
                        this.$root.$emit("updateFavouriteProductList", true);
                        this.$root.$emit("updateFavouriteProductList", true);
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => console.log(err));
        },
        removeProductToFavouriteList(slug) {
            axios
                .get(`/api/product/${slug}/favourite/remove`)
                .then((res) => {
                    if (res.data.status === 200) {
                        this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                        Alert.showSuccessAlert("Produktet er fjernet fra favoritlisten.");
                    }
                })
                .catch((err) => console.log(err));
        },
    },
    computed: {
        getProductUrl() {
            return `${APP_URL}/product/${this.product.slug}`;
        },

        isExpired() {
            let now = new Date();
            let expire = new Date(this.product.expire_date);
            return now > expire;
        },
        isLiked() {
            return this.product.isLikedByCurrentUser;
        },
        totalLiked() {
            return this.product.total_favourites;
        },
        isOfferTimeStarted() {
            let startDate = new Date(this.product.offer_start_date);
            let current_date = Date.now();
            return current_date > startDate;
        },
    },
    mounted() {
        this.isUserLiked = this.product.isLikedByCurrentUser;
        this.isUserFavourite = this.product.isFavouriteByCurrentUser;
        this.totalLikes = this.product.total_likes;
    },
};
</script>

<style scoped>
small {
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 1px;
}

h5 {
    font-weight: 700;
    font-size: 17px;
}

.sidebar-action {
    cursor: pointer;
}

.variations {
    display: flow-root;
}

.active {
    display: block;
}

.product_view_sidebar.shadow.position-fixed {
    min-width: 280px;
    max-width: 300px;
}

.button-wrap {
    position: relative;
    text-align: center;
    top: 50%;
    margin-top: -2.5em;
}

@media (max-width: 40em) {
    .button-wrap {
        margin-top: -1.5em;
    }
}

.variation {
    float: left;
}

.button-label {
    display: inline-block;
    padding: 5px 15px;
    margin-right: 0.5em;
    margin-top: 0.5em;
    cursor: pointer;
    color: #292929;
    border-radius: 0.25em;
    background: #ffffff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.22);
    transition: 0.3s;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 15px;
}

.button-label h1 {
    font-size: 1em;
    font-family: "Lato", sans-serif;
}

.button-label:hover {
    background: #d6d6d6;
    color: #101010;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.32);
}

.button-label:active {
    -webkit-transform: translateY(2px);
    transform: translateY(2px);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2),
    inset 0px -1px 0 rgba(0, 0, 0, 0.22);
}

@media (max-width: 40em) {
    .button-label {
        padding: 0em 1em 3px;
        margin: 0.25em;
    }
}

.radio-label:checked + .button-label {
    background: #ff844e;
    color: #efefef;
}

.hidden {
    display: none;
}

.clearfix {
    clear: both;
}
</style>
