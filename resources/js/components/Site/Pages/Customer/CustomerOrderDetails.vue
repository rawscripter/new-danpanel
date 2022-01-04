<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">
                    <loading
                        :color="'#00adf3'"
                        :active.sync="isLoading"
                        :can-cancel="false"
                        :loader="'dots'"
                        :is-full-page="false"
                    ></loading>
                    <div class="row" v-if="!isLoading">
                        <div class="col-md-6">
                            <div class="card border-0">
                                <div class="card-body shadow">
                                    <h5 class="mb-2"><strong>Ordre detaljer</strong></h5>
                                    <div class="table">
                                        <table class="table">
                                            <tr>
                                                <td>Ordre Nr</td>
                                                <td>:</td>
                                                <td>#{{ order.custom_order_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ordre Dato</td>
                                                <td>:</td>
                                                <td>{{ order.created_at }}</td>
                                            </tr>


                                            <tr>
                                                <td>Samlet beløb</td>
                                                <td>:</td>
                                                <td>{{ order.total_price }}</td>
                                            </tr>


                                            <tr>
                                                <td>Betaling status</td>
                                                <td>:</td>
                                                <td>{{ order.is_full_price_paid ? 'Betalt' : 'Ikke betalt' }}</td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0">
                                <div class="card-body shadow">
                                    <h5 class="mb-2"><strong>Forsendelse Detaljer</strong></h5>
                                    <div class="table">
                                        <table class="table">
                                            <tr v-if="order.shipping_info.name != null">
                                                <td>Navn</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.name }}</td>
                                            </tr>
                                            <tr v-if="order.shipping_info.phone != null">
                                                <td>Telefon</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.phone }}</td>
                                            </tr>
                                            <tr v-if="order.shipping_info.email != null">
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.email }}</td>
                                            </tr>
                                            <tr v-if="order.shipping_info.address != null">
                                                <td>Adresse</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.address }}</td>
                                            </tr>
                                            <tr v-if="order.shipping_info.city != null">
                                                <td>By</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.city }}</td>
                                            </tr>

                                            <tr v-if="order.shipping_info.zip_code != null">
                                                <td>Post Nr.</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.zip_code }}</td>
                                            </tr>


                                            <tr v-if="order.shipping_info.company_name != null">
                                                <td>Firmanavn</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.company_name }}</td>
                                            </tr>

                                            <tr v-if="order.shipping_info.cvr_number != null">
                                                <td>Cvr nr</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.cvr_number }}</td>
                                            </tr>

                                            <tr v-if="order.shipping_info.ean_number != null">
                                                <td>Ean nr</td>
                                                <td>:</td>
                                                <td>{{ order.shipping_info.ean_number }}</td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card border-0">
                                <div class="card-body shadow">
                                    <h5 class="mb-2"><strong>Produkter Detaljer</strong></h5>
                                    <div class="table">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col">#Sl.</th>
                                                <th scope="col">Produkt-id</th>
                                                <th scope="col">Produkter</th>
                                                <th scope="col">Unit Pris</th>
                                                <th scope="col">Variationer</th>
                                                <th scope="col">Antal</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(product,index) in order.products">
                                                <th scope="row">#{{ index + 1 }}</th>
                                                <th>{{ product.event_id }}</th>
                                                <th>{{ product.name }}</th>
                                                <th>{{ product.offer_price }} kr</th>
                                                <th class="text-left p-3">
                                                    <span class="d-block" v-for="sv in product.selected_variation">
                                                   {{ sv.variationOption.name }} <span
                                                        v-if="sv.variationOption.price"> +{{ sv.variationOption.price }} kr</span>
                                                        <span v-else> +0 kr</span>
                                                    </span>
                                                </th>
                                                <th>{{ product.quantity }}</th>
                                                <th>{{ product.total }} kr</th>
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
        </div>
    </div>
</template>

<script>
import CustomerLeftSidebar from "../../Layout/Customer/CustomerLeftSidebar";

export default {
    name: "CustomerOrderDetails",
    components: {
        CustomerLeftSidebar
    },
    data() {
        return {
            isLoading: false,
            orderId: null,
            order: null
        }
    },
    methods: {
        getOrderDetails() {
            axios.get(`${APP_URL}/api/order/${this.orderId}/details`)
                .then(res => {
                    this.isLoading = false;
                    this.order = res.data.order;
                }).catch(error => {
                console.error(error)
            })
        }
    },
    created() {
        this.isLoading = true;
        this.orderId = this.$route.params.order
        this.getOrderDetails()
    }
}
</script>

<style scoped>

</style>
