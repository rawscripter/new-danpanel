<template>
    <div class="page-wrapper">
        <div class="container">
            <loading
                :color="'#00adf3'"
                :active.sync="isPaymentLoading"
                :can-cancel="false"
                :loader="'dots'"
                :is-full-page="true"
            ></loading>

            <div>
                <!-- start checkout billing area  -->
                <div class="checkout-billing-area mt-4">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div id="dibs-complete-checkout"></div>
                        </div>
                        <div class="col-md-4 col-lg-4" v-if="!hideOrderDetailsForm">
                            <loading
                                :color="'#00adf3'"
                                :active.sync="isLoading"
                                :can-cancel="false"
                                :loader="'dots'"
                                :is-full-page="false"
                            ></loading>

                            <div class="checkout-customer-info">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="form-title mb-4 text-muted">
                                            <h5>Shipping Adresse</h5>
                                        </div>
                                        <form action="#" id="checkoutInforForm" @submit.prevent="saveShippingMethod">
                                            <div class="form-group">
                                                <label>Navn *</label>
                                                <input
                                                    v-model="shippingInfo.name"
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0"
                                                    name="name"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label>Adresse *</label>
                                                <input
                                                    v-model="shippingInfo.address"
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0"
                                                    name="address"
                                                />
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 ml-0 pl-0">
                                                    <div class="form-group">
                                                        <label>By *</label>
                                                        <input
                                                            type="text"
                                                            v-model="shippingInfo.city"
                                                            class="form-control form-control-sm rounded-0"
                                                            name="city" CategoryController
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mr-0 pr-0">
                                                    <div class="form-group">
                                                        <label>Post nr *</label>
                                                        <input
                                                            type="text"
                                                            v-model="shippingInfo.zip_code"
                                                            class="form-control form-control-sm rounded-0"
                                                            name="post_code"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input
                                                    type="email"
                                                    v-model="shippingInfo.email"
                                                    class="form-control form-control-sm rounded-0"
                                                    name="email"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label>Telefon nr *</label>
                                                <input
                                                    v-model="shippingInfo.phone"
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0"
                                                    name="email"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label>Bemærkning</label>
                                                <textarea
                                                    v-model="shippingInfo.note"
                                                    class="form-control form-control-sm"
                                                    rows="4"
                                                    name="note"
                                                ></textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-block btn-theme">Gem</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="col-md-4 col-lg-4"
                            id="delivery_method_area"
                            :class="enableShippingMethodArea ? 'enable' : 'disable' "
                            v-if="!hideOrderDetailsForm"
                        >
                            <div class="checkout-customer-info">
                                <div class="card border-0">
                                    <div class="card-body shadow">
                                        <div class="form-title mb-4 text-muted">
                                            <h5>Fragtmetode</h5>
                                        </div>
                                        <div class="select-shipping-method">

                                            <label class="checkbox_container">
                                                Send til min adresse
                                                <input v-model="shipping_method" value="hjemmelevering" type="radio"/>
                                                <span class="checkmark"></span>
                                            </label>

                                            <label class="checkbox_container">
                                                Hent selv (Faverland 6, 2600 Glostrup)
                                                <input v-model="shipping_method" value="hent_selv" type="radio"/>
                                                <span class="checkmark"></span>
                                            </label>


                                            <label class="checkbox_container">
                                                GLS
                                                <input v-model="shipping_method" value="gls" type="radio"/>
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 mt-3" v-if="shipping_method === 'gls'">
                                    <div class="card-body shadow">
                                        <div class="gls-points">
                                            <loading
                                                :color="'#00adf3'"
                                                :active.sync="isShippingMethodLoading"
                                                :can-cancel="false"
                                                :loader="'dots'"
                                                :is-full-page="false"
                                            ></loading>
                                            <div class="delivery-methods" v-if="!isShippingMethodLoading">
                                                <div
                                                    v-for="(method,index) in shippingMethods"
                                                    :key="index"
                                                    class="method bordered p-3"
                                                    :class="index === selectedMethod ? 'active': ''"
                                                    @click="selectedMethod = index"
                                                >
                                                    <div class="method-title">
                                                        <h5>
                                                            <strong>{{ method.CompanyName }}</strong>
                                                        </h5>
                                                        <small>
                                                            <span class="text-muted">{{ method.CityName }}</span>
                                                        </small>
                                                    </div>
                                                    <div
                                                        class="method-details text-muted"
                                                    >Address: {{ method.Streetname }} , {{ method.Streetname2 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- start checkout billing area  -->

                        <div
                            class="col-12 col-lg-4"
                            :class="enablePaymentArea ? 'enable' : 'disable' "
                            v-if="!hideOrderDetailsForm"
                        >
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
                                                <td>{{ ((subTotalPrice)) }} kr</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Fragt omkostninger:</strong>
                                                </td>
                                                <td>{{ ((orderDetails.shipping_cost)) }} kr</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Moms:</strong>
                                                </td>
                                                <td>{{ totalVat }} kr</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Total:</strong>
                                                </td>
                                                <td>{{ ((totalPrice)) }} kr</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" colspan="2">
                                                    <button @click="payNow" class="btn btn-block mt-3 btn-success">Godkend og betal
                                                    </button>
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
</template>

<script>
import UserLoginRegisterButton from "../Layout/UserLoginRegisterButton";

export default {
    name: "CheckoutPage",
    components: {
        UserLoginRegisterButton,
    },
    data() {
        return {
            hideOrderDetailsForm: false,
            shipping_method: null,
            selectedMethod: 0,
            isLoading: false,
            isShippingMethodLoading: false,
            isPaymentLoading: false,
            product: null,
            order: null,
            orderID: null,
            productSlug: null,
            isUserLoggedIn: User.loggedIn(),
            shippingInfo: {
                name: null,
                email: null,
                address: null,
                city: null,
                zip_code: null,
                phone: null,
                note: null,
            },
            orderDetails: {
                newsletter: 0,
                shipping_cost: 0,
                total: 0,
            },
            shippingMethods: [],
        };
    },

    watch: {

        shipping_method(value) {
            if (value === 'gls') {
                this.getGLSPickupPoints();
                if (this.orderDetails.total < 799) {
                    this.orderDetails.shipping_cost = 49;
                } else {
                    this.orderDetails.shipping_cost = 0;
                }

            } else if (value === 'hjemmelevering') {
                this.getGLSPickupPoints();
                if (this.orderDetails.total < 799) {
                    this.orderDetails.shipping_cost = 49;
                } else {
                    this.orderDetails.shipping_cost = 0;
                }

            } else {
                this.orderDetails.shipping_cost = 0;
                this.shippingMethods = [];
            }
        },
    },
    methods: {
        saveShippingMethod() {
            this.isShippingMethodLoading = true;
            this.getGLSPickupPoints();
        },

        getGLSPickupPoints() {
            this.isShippingMethodLoading = true;
            axios
                .post(`${APP_URL}/api/gls/shops`, this.shippingInfo)
                .then((response) => {
                    this.isShippingMethodLoading = false;
                    this.shippingMethods = response.data.parcelshops.PakkeshopData;
                })
                .catch((error) => {
                    Alert.showErrorAlert("Error");
                });
        },
        getUserInfo() {
            if (!this.isUserLoggedIn) return false;
            this.isLoading = true;
            axios
                .get(`${APP_URL}/api/user/get/info`)
                .then((response) => {
                    this.isLoading = false;
                    this.shippingInfo = response.data;
                    // this.getGLSPickupPoints();
                })
                .catch((error) => {
                    Alert.showErrorAlert("Error");
                });
        },

        payNow() {
            this.isPaymentLoading = true;

            axios
                .post(`${APP_URL}/api/order/create`, {
                    shipping_method_type: this.shipping_method,
                    shipping_method_details: this.shippingMethods[this.selectedMethod],
                    shipping_info: this.shippingInfo,
                    orderDetails: this.orderDetails,
                    products: this.$store.state.cart,
                })
                .then((response) => {
                    this.makeFullPaymentRequest(response.data.paymentId);
                    this.isPaymentLoading = false;
                })
                .catch((error) => {
                    Alert.showErrorAlert("Error");
                });
        },
        makeFullPaymentRequest(paymentId) {
            this.initCheckout(paymentId);
            this.hideOrderDetailsForm = true;
        },
        initCheckout(paymentID) {
            var checkoutOptions = {
                checkoutKey: "live-checkout-key-014b3802470340e090c2e8f0f8295861", // for live [Required] Test or Live GUID with dashes
                paymentId: paymentID, //[required] GUID without dashes
                partnerMerchantNumber: "123456789", //[optional] Number
                containerId: "dibs-complete-checkout", //[optional] defaultValue: dibs-checkout-content
                language: "da-DK", //[optional] defaultValue: en-GB
                theme: {
                    // [optional] - will change defaults in the checkout
                    textColor: "blue", // any valid css color
                    linkColor: "#bada55", // any valid css color
                    panelTextColor: "rgb(125, 125, 125)", // any valid css color
                    panelLinkColor: "#0094cf", // any valid css color
                    primaryColor: "#0094cf", // any valid css color
                    buttonRadius: "50px", // pixel or percentage value
                    buttonTextColor: "#fff", // any valid css color
                    backgroundColor: "#fafafa", // any valid css color
                    panelColor: "#fff", // any valid css color
                    outlineColor: "#444", // any valid css color
                    primaryOutlineColor: "#444", // any valid css color   }
                },
            };
            var checkout = new Dibs.Checkout(checkoutOptions);
            //this is the event that the merchant should listen to redirect to the “payment-is-ok” page
            checkout.on("payment-completed", function (response) {
                window.location = "/checkout?paymentId=" + response.paymentId;
            });
        },
    },
    computed: {
        subTotalPrice() {
            let total = 0;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }
            return total.toFixed(2);
        },

        totalPrice() {
            let total = this.orderDetails.shipping_cost;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }
            this.orderDetails.total = total.toFixed(2);
            return total.toFixed(2);
        },

        totalVat() {
            let taxPrice = 0;

            for (let item of this.$store.state.cart) {
                taxPrice += item.taxPrice;
            }
            return taxPrice.toFixed(2);
        },

        enablePaymentArea() {
            if (this.shipping_method === 'hjemmelevering' || this.shipping_method === 'hent_selv') {
                return true;
            }
            if (Array.isArray(this.shippingMethods)) {
                return this.shippingMethods.length > 0;
            }
            return false;
        },
        enableShippingMethodArea() {
            return (
                this.shippingInfo.city !== null && this.shippingInfo.zip_code !== null
            );
        },
    },
    created() {
        // this.isLoading = true;
        this.getUserInfo();
    },
};
</script>

<style scoped>
.form-group {
    margin-bottom: 0rem;
}

.form-group {
    margin-bottom: 0rem;
}

.paymethode-area {
    margin-top: 10px;
}

.paymethode-area p {
    color: #989191;
    font-size: 14px;
    margin-top: 4px;
    text-transform: uppercase;
}

.paymethode-area img {
    width: 30px;
    height: 22px;
    margin: 2px;
}

.terms-condition-single input {
    margin-right: 10px;
    margin-top: 5px;
}

input.form-control.form-control-sm.rounded-0 {
    margin-bottom: 8px;
    height: 40px;
    border-radius: 5px !important;
    border-color: #e8e8e8;
}

#oqty {
    width: 100px;
    text-align: center;
    /* border-color: #aaaaaa; */
    border: 1px solid #eaeaea;
    padding: 5px 10px;
    font-size: 16px;
    color: #858585;
    border-radius: 4px;
}

.text-default {
    color: #000 !important;
}

.checkout-table tr {
    margin-top: 10px;
}

.checkmark {
    border-radius: 0%;
}

.delivery-methods .method {
    cursor: pointer;
    border-radius: 10px;
    margin-bottom: 15px;
}

.method.bordered {
    border: 1px solid #e2e2e2;
}

.method.bordered.active {
    border-color: #ff973a;
}

.disable {
    pointer-events: none;
    opacity: 0.5;
}
</style>
