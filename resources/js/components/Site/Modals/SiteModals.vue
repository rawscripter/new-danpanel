<template>
    <div>
        <div
            v-if="productRequestModal"
            class="modal fade bd-example-modal-sm show"
            tabindex="-1"
            role="dialog"
            aria-labelledby="mySmallModalLabel"
            :class="productRequestModal?'active':''"
            style="margin-right: 0rem;"
        >
            <div class="modal-dialog" style="margin-top: 250px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productRequestModals">Anmodning om favorit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="productRequestModal=false" aria-hidden="true">×</span>
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

        <div
            v-if="showSocialShareModal"
            class="modal fade bd-example-modal-sm show"
            tabindex="-1"
            role="dialog"
            aria-labelledby="mySmallModalLabel"
            :class="showSocialShareModal?'active':''"
            style="padding-right: 17px; padding-top:5rem;"
        >
            <div class="modal-dialog" style="margin-top: 250px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Del</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="showSocialShareModal=false" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <social-sharing
                            :url="getProductUrl"
                            :title="product.name"
                            :description="product.short_des"
                            :quote="product.short_des"
                            inline-template
                        >
                            <div id="social-share">
                                <network class="social" network="email">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Email.png" alt/> Email
                                </network>
                                <network class="social" network="facebook">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Facebook.png" alt/>
                                    Facebook
                                </network>
                                <network class="social" network="googleplus">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Google+.png" alt/> Google +
                                </network>
                                <!-- <network class="social" network="line">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Line.png" alt/> Line
                                </network> -->
                                <network class="social" network="linkedin">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---LinkedIn.png" alt/>
                                    LinkedIn
                                </network>
                                <network class="social" network="pinterest">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Pinterest.png" alt/>
                                    Pinterest
                                </network>
                                <!-- <network class="social" network="reddit">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Reddit.png" alt/> Reddit
                                </network> -->
                                <network class="social" network="skype">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Skype.png" alt/> Skype
                                </network>
                                <network class="social" network="sms">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---SMS.png" alt/> SMS
                                </network>
                                <!-- <network class="social" network="telegram">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Telegram.png" alt/>
                                    Telegram
                                </network> -->
                                <network class="social" network="twitter">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Twitter.png" alt/> Twitter
                                </network>
                                <!-- <network class="social" network="vk">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Vkontakte.png" alt/>
                                    VKontakte
                                </network> -->
                                <!-- <network class="social" network="weibo">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Weibo.png" alt/> Weibo
                                </network> -->
                                <network class="social" network="whatsapp">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Whatsapp.png" alt/>
                                    Whatsapp
                                </network>
                            </div>
                        </social-sharing>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SiteModals",
    data() {
        return {
            productRequestModal: false,
            showSocialShareModal: false,
            product: null,
            productRequest: {
                email: null,
                note: null,
                type: "favourite",
            },
        };
    },
    methods: {
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
    },
    mounted() {
        this.$root.$on("callProductRequestModal", (product) => {
            this.product = product;
            this.productRequestModal = true;
        });


        this.$root.$on("shareProduct", (product) => {
            this.product = product;
            this.showSocialShareModal = true;
        });
    },
    computed: {
        getProductUrl() {
            return `${APP_URL}/product/${this.product.slug}`;
        }
    }
};
</script>

<style scoped>
.active {
    display: block;
}
</style>
