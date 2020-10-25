<template>
    <div class="page-wrapper">
        <div class="container">
            <loading :active.sync="isLoading" :is-full-page="true"></loading>
            <!-- start checkout product info area  -->
            <div v-if="!isLoading">
                <div class="product-info-area mt-4 shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table text-center" v-if="$store.state.cart.length > 0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produktbillede</th>
                                <th>Varer</th>
                                <th>
                                    Pris
                                    <!-- <br/>(del 1 of two betalinger) -->
                                </th>
                                <th>Antal</th>
                                <!--                                <th>Bemærk</th>-->
                                <th>I alt</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product,index) in $store.state.cart" :key="product.id">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <img :src="product.thumbImage" :alt="product.name" style="width:50px"/>
                                </td>
                                <td>
                                    <router-link
                                        class="text-default"
                                        :to="{name: 'product-details', params:{slug:product.slug}}"
                                    >
                                        {{ product.name }}
                                        <span
                                            v-for="variation in product.variations"
                                            :key="variation.optionID"
                                        >
                        <span class="p-1">|</span>
                        {{ variation.optionName }}
                      </span>
                                    </router-link>
                                </td>
                                <td>{{ product.offer_price }} Kr</td>
                                <td>
                                    <button
                                        type="button"
                                        @click="decreaseOrderQuantity(product)"
                                        class="btn btn-success btn-sm rounded mr-0"
                                    >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input
                                        :max="product.max_unit_per_user"
                                        type="number"
                                        id="quantity"
                                        readonly
                                        min="1"
                                        v-model="product.quantity"
                                        style="width:60px;text-align:center"
                                    />
                                    <button
                                        type="button"
                                        @click="increaseOrderQuantity(product)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                                <!--                                <td style="width:25%">-->
                                <!--                                    <p class="m-0 p-0" v-html="product.order_note"></p>-->
                                <!--                                </td>-->
                                <td>
                                    {{ product.totalPrice.toFixed(2) }} Kr
                                    <br/>
                                    Heraf moms : {{ product.taxPrice.toFixed(2) }} Kr
                                </td>
                                <td>
                                    <div class="btn btn-sm btn-danger" @click.prevent="removeFromCart(product)">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-else class="text-center">
                            <h4 class="text-muted">Indkøbskurven er tom.</h4>

                            <br><br>

                            <router-link to="/" class="back-to-home">
                                Tilbage til forsiden
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- end checkout product info area  -->
                <!--                <UserLoginRegisterButton v-if="!isUserLoggedIn" :nextPageUri="'/cart'"></UserLoginRegisterButton>-->

                <div class="shipping-info-and-checkout-section" v-if="$store.state.cart.length > 0">
                    <!-- start checkout billing area  -->
                    <div class="checkout-billing-area mt-4" v-if="!isLoading">
                        <div class="row">
                            <div class="col-12 col-lg-4 ml-auto">
                                <div class="checkout-customer-info">
                                    <div class="cards shadow">
                                        <div class="card-header-title">
                                            <h5 class="text-center">
                                                <strong>Ordredetaljer</strong>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="checkout-table table table-hover" style="width:100%">
                                                <tr>
                                                    <td>
                                                        <strong>Sub Total:</strong>
                                                    </td>
                                                    <td>{{ ((totalPrice)) }} dkk</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>Moms:</strong>
                                                    </td>
                                                    <td>{{ totalVat }} dkk</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>Total:</strong>
                                                    </td>
                                                    <td>{{ ((totalPrice)) }} dkk</td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="2" colspan="2">
                                                        <router-link
                                                            tag="button"
                                                            :to="{name:'final-checkout'}"
                                                            class="btn btn-block mt-3 btn-success"
                                                        >Bestil
                                                        </router-link>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start checkout billing area  -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserLoginRegisterButton from "../Layout/UserLoginRegisterButton";

export default {
    name: "Cart",
    components: {
        UserLoginRegisterButton,
    },
    data() {
        return {
            isLoading: false,
            hideOrderDetailsForm: false,
            isUserLoggedIn: User.loggedIn(),
            totalProduct: this.$store.state.cart.length,
        };
    },
    methods: {
        removeFromCart(item) {
            this.$cookies.remove(`product-variation-${item.id}`);

            this.$store.commit("removeFromCart", item);
            this.$store.commit("saveCart");
            this.$toast.success("Vare fjernet fra kurv");
        },
        increaseOrderQuantity(product) {
            this.$store.commit("increaseOrderQuantity", product);
            this.$store.commit("saveCart");
        },
        decreaseOrderQuantity(product) {
            if (product.quantity > 1) {
                this.$store.commit("decreaseOrderQuantity", product);
                this.$store.commit("saveCart");
            } else {
                this.$toast.error("Minimum ordremængde er 1");
            }
        },
    },
    computed: {
        totalPrice() {
            let total = 0;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }
            return total.toFixed(2);
        },

        totalVat() {
            let taxPrice = 0;

            for (let item of this.$store.state.cart) {
                taxPrice += item.taxPrice;
            }
            return taxPrice.toFixed(2);
        },
    },
};
</script>

<style scoped>
.back-to-home {
    font-size: 19px;
    text-decoration: underline;
    color: #3939396b;
    transition: 0.3s;
    font-family: 'Dosis', sans-serif;
}

.back-to-home:hover {
    color: #ea782a;
}
</style>
