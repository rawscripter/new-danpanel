<template>
    <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg" :class="tableHeadClass">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            {{ orderStatus.toUpperCase() }} ORDERS <span v-if="isSending">| Sending mail...</span>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <div class="table-responsivess">
                        <v-server-table :url="serverRequestUrl" ref="myTable"
                                        :columns="columns"
                                        :options="options">
                                                 <span slot="is_join_price_paid"
                                                       slot-scope="{row}">
                                                    <span v-if="row.is_join_price_paid"
                                                          class="kt-badge kt-badge--inline kt-badge--success">Paid</span>
                                                     <span v-else class="kt-badge kt-badge--inline kt-badge--warning">Not Paid</span>
                                                 </span>
                            <span slot="is_full_price_paid"
                                  slot-scope="{row}">
                                <span v-if="row.is_full_price_paid" class="kt-badge kt-badge--inline kt-badge--success">Paid</span>
                                <span v-else class="kt-badge kt-badge--inline kt-badge--warning">Not Paid</span>
                            </span>
                            <span slot="order_status" slot-scope="{row}">
                                                            <div v-if="!row.is_canceled">
                                                                  <span v-if="row.order_status"
                                                                        class="kt-badge kt-badge--inline kt-badge--success">Compete</span>
                                                     <span v-else class="kt-badge kt-badge--inline kt-badge--info">Running</span>
                                                            </div>
<div v-else>
     <span class="kt-badge kt-badge--inline kt-badge--danger">Canceled</span>
</div>
                                                        </span>
                            <span slot="actions" slot-scope="{row}">


                                <router-link :to="{name:'admin-order-details',params:{order:row.custom_order_id}}"
                                             class="btn btn-sm btn-primary">
                                            Order Details
                                </router-link>

                             <button @click="resendMail(row.id)" v-if="!row.is_full_price_paid" class="btn btn-warning">
                                        Resend Mail
                                </button>




                            </span>
                        </v-server-table>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "ProductIndex",
    data() {
        return {
            isSending: false,
            orderStatus: 'all',
            product: null,
            columns: ['id',
                'custom_order_id',
                'total_price',
                'customer.id',
                'customer.name',
                'customer.email',
                'is_full_price_paid',
                'order_status',
                'created_at',
                'actions'
            ],
            options: {
                headings: {
                    id: 'ID',
                    'customer.id': 'Customer ID',
                    'customer.name': 'Customer Name',
                    'customer.email': 'Email',
                    custom_order_id: 'Order ID',
                    total_price: 'Amount',
                    created_at: 'Order At',
                    order_status: 'Order Status',
                    is_full_price_paid: 'Payment Status',
                    actions: 'Actions'
                },
                perPage: 10,
                perPageValues: [10, 20, 25, 50, 100],
                sortable: ['name', 'custom_order_id', 'created_at', 'order_status', 'is_join_price_paid', 'is_full_price_paid', 'quantity'],
                filterable: ['name'],
                responseAdapter: function (resp) {
                    return {
                        data: resp.data.orders,
                        count: resp.data.total,
                    }
                }
            },
        }
    },
    methods: {
        orderDetails(categoryID) {
        },
        resendMail(orderId) {
            this.isSending = true;
            axios.post(`${APP_URL}/api/admin/order/${orderId}/resend-mail`)
                .then(res => {
                    if (res.data.status == 200) {
                        Alert.showSuccessAlert(res.data.message)
                    } else {
                        Alert.showErrorAlert('Request Failed.')
                    }
                    this.isSending = false;
                })
        }
    },
    computed: {
        serverRequestUrl() {
            if (this.product != null) {
                return `${APP_URL}/api/admin/orders?status=${this.orderStatus}&product=${this.product}`;
            } else if (this.customer != null) {
                return `${APP_URL}/api/admin/orders?status=${this.orderStatus}&customer=${this.customer}`;
            } else {
                return `${APP_URL}/api/admin/orders?status=${this.orderStatus}`;
            }
        },
        tableHeadClass() {
            if (this.orderStatus === 'all') {
                return 'all-orders';
            }
            if (this.orderStatus === 'running') {
                return 'running-orders';
            }
            if (this.orderStatus === 'canceled') {
                return 'canceled-orders';
            }

            if (this.orderStatus === 'complete') {
                return 'complete-orders';
            }
        }
    },
    watch: {
        '$route.query': {
            immediate: true,
            handler(newVal) {
                this.orderStatus = newVal.status;
            }
        }
    },
    created() {
        if (this.$route.query.status) {
            this.orderStatus = this.$route.query.status;
            this.product = this.$route.query.product;
            this.customer = this.$route.query.customer;
        }
    }

}
</script>

<style>
.VueTables__search-field {
    display: flex !important;
}

.VueTables__search-field label, .VueTables__limit-field label {
    margin-right: 10px;
}

.VueTables__limit-field {
    display: flex !important;
}

.running-orders {
    background: #5578eb;
}

.running-orders .kt-font-brand {
    color: #ffffff !important;
}

.running-orders h3 {
    color: #fff !important;
}

.complete-orders {
    background: #0abb87;
}

.complete-orders .kt-font-brand {
    color: #ffffff !important;
}

.complete-orders h3 {
    color: #fff !important;
}

.canceled-orders {
    background: #fd397a;
}

.canceled-orders .kt-font-brand {
    color: #ffffff !important;
}

.canceled-orders h3 {
    color: #fff !important;
}

.kt-badge.kt-badge--inline {
    font-size: 13px;
}
</style>
