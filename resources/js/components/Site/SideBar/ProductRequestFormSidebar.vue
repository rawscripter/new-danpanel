<template>
    <div class="product_view_sidebar shadow  ">


        <div class="form">
            <div class="form-header mt-3 mb-3">
                <h5><strong>Udfyld venligst formularen</strong></h5>
            </div>

            <loading
                :color="'#00adf3'"
                :active.sync="isLoading"
                :can-cancel="false"
                :loader="'dots'"
                :is-full-page="false"
            ></loading>
            <div v-if="!request_sent">
                <div class="product-question" v-if="this.product.product_variation.length">
                    <div class="product-variations mt-3 mb-3" v-if="step === 0">
                        <div v-for="variation in product.product_variation" :key="variation.id" class="pt-2 pb-2">
                            <div>
                                <strong>{{ variation.name }}:</strong>
                            </div>
                            <div class="variations row mb-3">
                                <div class="pl-0 col-md-6" v-for="option in variation.options" :key="option.id">
                                    <div class="variation"><input
                                        class="hidden radio-label"
                                        :id="`radio-btn-${option.id}`"
                                        type="radio"
                                        :value="option.id"
                                        :name="`variationOption[${variation.id}]`"
                                        :checked="isOptionAlreadySelected(option.id)"
                                    />
                                        <label
                                            @click="changeProductPriceOnVariationChange(variation.id,option.id,option.price)"
                                            class="button-label"
                                            :for="`radio-btn-${option.id}`"
                                        >
                                    <span>
                                      {{ option.name }}
                                      <span v-if="option.price >0">+{{ option.price }}kr</span>
                                    </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-theme btn-block" @click="goToFormSection">Næste</button>
                    </div>
                </div>
                <form action="" v-if="step === 1" @submit.prevent="submitFormData">
                    <div class="form-group">
                        <!-- <label for="">Navn</label> -->
                        <input type="text" v-model="formData.name" placeholder="Navn" class="form-control">
                    </div>

                    <div class="form-group">
                        <!-- <label for="">Email </label> -->
                        <input type="text" v-model="formData.email" placeholder="Email" class="form-control">
                    </div>

                    <div class="form-group">
                        <!-- <label for="">Telefon </label> -->
                        <input type="text" v-model="formData.phone" placeholder="Telefon" class="form-control">
                    </div>
                    <div class="form-group" v-if="!private_channel">
                        <!-- <label for="">Telefon </label> -->
                        <input type="text" v-model="formData.cvr_number" placeholder="CVR" class="form-control">
                    </div>

                    <div class="form-group">
                        <!-- <label for="">Besked</label> -->
                        <textarea name="" v-model="formData.note" id="" placeholder="Besked" cols="10" rows="5"
                                  class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-theme btn-block" type="submit">Indsend</button>
                    </div>
                </form>
            </div>
            <div v-else>
                <div class="alert">
                    <div class="alert-success p-3">
                        Anmodning sendt med succes.
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "ProductRequestFormSidebar",
    props: ['product'],
    data() {
        return {
            step: this.product.product_variation.length > 0 ? 0 : 1,
            private_channel: true,
            isLoading: false,
            request_sent: false,
            formData: {
                product_id: this.product.id,
                selectedVariations: [],
                name: null,
                email: null,
                phone: null,
                cvr_number: null,
                note: null,
            }
        }
    },
    created() {
        let previous_selected_channel = this.$cookies.get(`product-channel`);
        this.private_channel = previous_selected_channel !== "business";
        console.log(this.private_channel)
    },
    methods: {
        submitFormData() {
            this.isLoading = true;

            axios.post(`${APP_URL}/api/product/${this.product.slug}/make/request`, this.formData)
                .then(res => {
                    this.$toast.success("Formular indsendt.");
                    this.isLoading = false;
                    this.request_sent = true;
                }).catch(err => {
                this.$toast.error("Request Failed.");
            })
        },
        goToFormSection() {
            // let totalVariationsOfProduct = this.product.product_variation.length;
            // if (totalVariationsOfProduct !== this.formData.selectedVariations.length) {
                // this.$toast.error("Besvar spørgsmålene først.");
                // return 0;
            // } else {
                this.step = 1;
            // }

        },
        isOptionAlreadySelected(optionID) {
            return this.formData.selectedVariations.find((x) => x.optionID === optionID);
            // return selectedIndex !== -1;
        },
        changeProductPriceOnVariationChange(variationID, optionID, price) {
            let selectedIndex = this.formData.selectedVariations.findIndex(
                (x) => x.variationID === variationID
            );
            // already selected
            if (selectedIndex !== -1) {
                if (this.formData.selectedVariations[selectedIndex].optionID === optionID)
                    return;
                let optionVariationOptionId = this.formData.selectedVariations[selectedIndex]
                    .optionID;
                let productVariations = this.product.product_variation[selectedIndex];
                let optionVariationOptionIndex = productVariations.options.findIndex(
                    (x) => x.id === parseInt(optionVariationOptionId)
                );
                let optionVariationOption =
                    productVariations.options[optionVariationOptionIndex];
                this.formData.selectedVariations[selectedIndex].optionID = optionID;
            } else {
                let newObject = {
                    variationID: variationID,
                    optionID: optionID,
                };
                this.formData.selectedVariations.push(newObject);
            }
        },
    }
}
</script>

<style scoped>
label {
    cursor: pointer;
    margin: 0px !important;
}

.variation {
    padding: 10px;
    background: #e8e8e8;
    border-radius: 10px;
    margin-top: 8px;
}
</style>
