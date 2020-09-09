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

                    <div class="card border-0">
                        <div class="card-body shadow">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table">
                                        <table class="table">
                                            <tr>
                                                <td>Order Number</td>
                                                <td>:</td>
                                                <td>#kjksdfdf</td>
                                            </tr>
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
        this.orderId = this.$route.params.order
        this.getOrderDetails()
    }
}
</script>

<style scoped>

</style>
