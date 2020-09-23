<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">

                    <div id="dibs-complete-checkout"></div>
                    <div class="main-content" v-if="!hideOrderDetailsForm">
                        <loading
                            :color="'#00adf3'"
                            :active.sync="isLoading"
                            :can-cancel="false"
                            :loader="'dots'"
                            :is-full-page="false"
                        ></loading>
                        <div class="user-profile-all-order p-3">
                            <h5 class="text-center">Mine ordrer</h5>
                            <hr>
                            <div class="table-responsive shadow wow bounceInUp">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">#Sl.</th>
                                        <th scope="col">Ordrer ID</th>
                                        <th scope="col">Produkt</th>
                                        <th scope="col">Beløb</th>
                                        <th scope="col">Betalt</th>
                                        <th scope="col">Dato</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(order,index) in orders">
                                        <th scope="row">#{{ index + 1 }}</th>
                                        <th scope="row">#{{ order.custom_order_id }}</th>
                                        <th scope="row">
                                            <p v-for='product in order.products'>
                                                {{ product.name }}
                                                <span v-for="sv in product.selected_variation">
                                                   | {{ sv.variationOption.name }}
                                                </span>

                                            </p>
                                        </th>
                                        <td>{{ order.total_price }} kr</td>
                                        <td>
                                            <span v-if="order.is_full_price_paid">Betalt</span>
                                            <span v-else>Ikke betalt</span>
                                        </td>
                                        <td>
                                            {{ order.created_at }}
                                        </td>
                                        <td>
                                            <router-link class="btn btn-sm btn-theme"
                                                         :to="{name:'customer-order-details',params:{order:order.custom_order_id}}">
                                                Se detaljer
                                            </router-link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import CustomerLeftSidebar from "../../Layout/Customer/CustomerLeftSidebar";

export default {
    name: "CustomerOrders",
    components: {
        CustomerLeftSidebar,
    },

    data() {
        return {
            showChartModal: true,

            orderType: 'running',
            orders: [],
            isLoading: false,
            isPaymentBoxLoading: false,
            hideOrderDetailsForm: false,
            orderDetails: {
                productId: null,
                quantity: 1,
                totalPrice: 0,
                unitPrice: 0,
            }
        }
    },
    methods: {
        getCustomerOrders() {
            axios.get(`${APP_URL}/api/customer/orders?status=${this.orderType}`)
                .then(res => {
                    this.isLoading = false;
                    this.orders = res.data.orders;
                }).catch(error => {
                console.error(error)
            })
        },
    },
    created() {
        this.isLoadin = true;
        if (this.$route.query.type) {
            this.orderType = this.$route.query.type;
        }

        this.getCustomerOrders()
    }
}
</script>

<style scoped>
.bottom-pane {
    margin-top: 0px;
    border-radius: 5px;
    background-color: #eaeaea;
    padding: 5px;
    border: 0px;
    text-align: center;
    width: 35px;
}

.num {
    font-size: 16px;
    color: #000;
    font-weight: bold;
}

span.expired {
    font-weight: bold;
    color: red;
    font-size: 18px;
}

.table td, .table th {
    vertical-align: middle;
}

.non-hover {
    cursor: text !important;
}

.show-graph {
    display: block;
}
</style>
