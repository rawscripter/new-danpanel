<template>
  <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
    <div class="col-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Edit Product</h3>
          </div>
        </div>
        <div class="kt-portlet__body" v-if="!isLoading">
          <!--begin: Datatable -->
          <div v-if="formData.category_id == 2" class="mb-5">
            <h5>Slide Images</h5>
            <vue-dropzone
              v-on:vdropzone-success="refresh"
              ref="myVueDropzone"
              id="dropzone"
              :options="dropzoneOptionsForPackageProduct"
            ></vue-dropzone>

            <div class="mt-3" v-if="formData.productSlideImages.length > 0">
              <p>Attached Images</p>
              <div class="removeAttachedImage">
                <div
                  v-for="(image, index) in formData.productSlideImages"
                  class="image"
                  @click="removeSliderImage(index)"
                  :key="index"
                >
                  <img
                    :src="image.thumbImage"
                    width="60px"
                    class="imag"
                    alt="img-thumbnail"
                  />
                  <button class="btn btn-sm mt-2 text-danger">Delete</button>
                </div>
              </div>
            </div>
          </div>
          <h5>Upload Feature Image</h5>
          <vue-dropzone
            v-on:vdropzone-success="refresh"
            ref="myVueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
          ></vue-dropzone>

          <div class="mt-3" v-if="formData.productImages.length > 0">
            <p>Feature Images</p>
            <div class="removeAttachedImage">
              <div
                v-for="(image, index) in formData.productImages"
                class="image d-flex flex-column justify-content-center"
                @click="removeProductImage(index)"
                :key="index"
              >
                <img
                  :src="image.thumbImage"
                  width="60px"
                  class="imag"
                  alt="img-thumbnail"
                />
                <button class="btn btn-sm mt-2 text-danger">Delete</button>
              </div>
            </div>
          </div>
          <br />
          <br />
          <form @submit.prevent="saveFormData">
            <div class="form-group row">
              <div class="col-md-12">
                <label class="col-form-label">Product Name:</label>
                <input
                  required
                  v-model="formData.name"
                  class="form-control"
                  for="category_name"
                  type="text"
                />
              </div>
              <div class="col-md-6">
                <label for="categories" class="col-form-label"
                  >Select Category:</label
                >
                <select
                  required
                  v-on:change="getSubCategories"
                  v-model="formData.category_id"
                  id="categories"
                  class="form-control"
                >
                  <option>Select Category</option>
                  <option
                    v-for="category in categories"
                    v-bind:value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="subCategories" class="col-form-label"
                  >Select Sub Category:</label
                >
                <select
                  v-model="formData.sub_category_id"
                  id="subCategories"
                  class="form-control"
                >
                  <option>Select Category</option>
                  <option
                    v-for="subCategory in subCategories"
                    v-bind:value="subCategory.id"
                  >
                    {{ subCategory.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-12">
                <label for="short_des" class="col-form-label"
                  >Short Description:</label
                >
                <textarea
                  required
                  v-model="formData.short_des"
                  rows="5"
                  cols="5"
                  class="form-control"
                  id="short_des"
                  type="text"
                ></textarea>
              </div>

              <div class="col-md-12">
                <label for="full_des" class="col-form-label"
                  >Full Description:</label
                >
                <ckeditor
                  :editor="editor"
                  v-model="formData.full_des"
                  :config="editorConfig"
                ></ckeditor>
              </div>

              <div class="col-md-12">
                <label class="col-form-label">Ordrenotat:</label>
                <ckeditor
                  :editor="editor"
                  v-model="formData.order_note"
                  :config="editorConfig"
                ></ckeditor>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="market_price" class="col-form-label"
                    >Market Price:</label
                  >
                  <input
                    required
                    v-model="formData.market_price"
                    class="form-control"
                    id="market_price"
                    type="text"
                    step="2"
                  />
                </div>

                <div class="form-group">
                  <label for="product_image" class="col-form-label"
                    >Product Image:</label
                  >
                  <div class="text-left m-2" v-if="formData.fullImage">
                    <img
                      :src="formData.fullImage"
                      class="img-responsive"
                      width="100px"
                    />
                  </div>
                  <input
                    v-on:change="onImageChange"
                    class="form-control"
                    id="product_image"
                    type="file"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="offer_price" class="col-form-label"
                    >Offer Price:</label
                  >
                  <input
                    required
                    v-model="formData.offer_price"
                    class="form-control"
                    id="offer_price"
                    type="text"
                  />

                  <br />
                  <div class="form-check">
                    <input
                      v-model="formData.is_offer_expirable"
                      class="form-check-input"
                      type="checkbox"
                      name="exampleRadios"
                      id="is_offer_expirable"
                      value="1"
                    />
                    <label class="form-check-label" for="is_offer_expirable">
                      Set Product Expire Time
                    </label>
                  </div>

                  <div class="" v-if="formData.is_offer_expirable">
                    <label for="expire_date" class="col-form-label"
                      >Expire Date:</label
                    >
                    <input
                      required
                      v-model="formData.expire_date"
                      class="form-control"
                      id="expire_date"
                      type="datetime-local"
                    />
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <label for="xxxx" class="col-form-label">Product Type:</label>
                <br />
                <div class="form-group d-flex">
                  <div class="form-check mr-5">
                    <input
                      v-model="formData.product_channel"
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="exampleRadios1"
                      value="private"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      Private
                    </label>
                  </div>
                  <div class="form-check">
                    <input
                      v-model="formData.product_channel"
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="exampleRadios2"
                      value="business"
                      checked
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      Business
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <select
                    v-model="formData.product_type"
                    name=""
                    class="form-control"
                    id="xxxx"
                    multiple
                  >
                    <option v-for="type in productTypes" :value="type">
                      {{ type }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group row mt-2">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <h5>Product Variation</h5>
                    <div class="text-right">
                      <button
                        class="btn btn-info btn-sm"
                        type="button"
                        @click="showProductVariationModal = true"
                      >
                        Add Product Variation
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div
                        class="col-md-3"
                        v-for="(
                          variation, variationIndex
                        ) in formData.product_variation"
                      >
                        <div class="card shadow">
                          <div
                            class="card-header d-flex justify-content-between"
                          >
                            <h5>{{ variation.name }}</h5>
                            <div class="action">
                              <span
                                class="btn btn-sm btn-success"
                                @click="addVariationOption(variationIndex)"
                                >+</span
                              >
                              <span
                                @click="deleteProductVariation(variationIndex)"
                                class="btn btn-sm btn-danger"
                              >
                                <i
                                  style="position: unset"
                                  class="la la-trash"
                                ></i>
                              </span>
                            </div>
                          </div>
                          <div class="body p-3">
                            <table class="table">
                              <tr>
                                <td>Variation Options</td>
                                <td>Price</td>
                                <td>Action</td>
                              </tr>

                              <tr
                                v-for="(
                                  option, optionIndex
                                ) in variation.options"
                              >
                                <td>{{ option.name }}</td>
                                <td>{{ option.price }}</td>
                                <td>
                                  <div class="action">
                                    <span
                                      @click="
                                        deleteProductVariationOption(
                                          variationIndex,
                                          optionIndex
                                        )
                                      "
                                      class="btn btn-sm btn-danger p-1"
                                    >
                                      <i
                                        style="position: unset"
                                        class="la la-trash"
                                      ></i>
                                    </span>
                                  </div>
                                </td>
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

            <div class="form-group row mt-2">
              <div class="col-12">
                <input
                  class="btn btn-block btn-primary"
                  type="submit"
                  value="Update Product"
                />
              </div>
            </div>
          </form>
          <!--end: Datatable -->

          <div v-if="errors_exist">
            <div
              v-for="(error, index) in validationErrors"
              class="alert alert-outline-danger"
              :key="index"
            >
              {{ error }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade show"
      id="kt_select_modal"
      role="dialog"
      aria-modal="true"
      style="padding-right: 17px"
      :class="showProductVariationModal ? 'active' : ''"
    >
      <div class="modal-dialog" style="margin-top: 150px" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Product Variation</h5>
            <button
              @click="showProductVariationModal = !showProductVariationModal"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-lg-10 col-md-10 col-sm-12">
                <input
                  v-model="newProductVariation"
                  placeholder="Add new Size"
                  type="text"
                  class="form-control"
                />
              </div>
              <div class="col-lg-2 col-md-2">
                <button
                  @click="addProductVariation"
                  class="btn btn-primary btn-block"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="showProductVariationModal = !showProductVariationModal"
              type="button"
              class="btn btn-primary mr-2"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade show"
      id="kt_select_modals"
      role="dialog"
      aria-modal="true"
      style="padding-right: 17px"
      :class="showProductVariationOptionModal ? 'active' : ''"
    >
      <div class="modal-dialog" style="margin-top: 150px" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Product Variation</h5>
            <button
              @click="
                showProductVariationOptionModal =
                  !showProductVariationOptionModal
              "
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                  <label for="opt">Variation Option</label>
                  <input
                    id="opt"
                    v-model="variationOption.name"
                    placeholder="Name"
                    type="text"
                    class="form-control"
                  />
                </div>
                <div class="form-group">
                  <label for="price_var">Price</label>
                  <input
                    id="price_var"
                    v-model="variationOption.price"
                    placeholder="ex. 100"
                    type="text"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button
              @click="
                showProductVariationOptionModal =
                  !showProductVariationOptionModal
              "
              type="button"
              class="btn btn-danger mr-2"
              data-dismiss="modal"
            >
              Close
            </button>
            <button @click="addProductVariationOption" class="btn btn-primary">
              Add
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "ProductEdit",
  components: {
    vueDropzone: vue2Dropzone,
  },
  data() {
    return {
      showProductVariationModal: false,
      showProductVariationOptionModal: false,
      isLoading: false,
      productTypes: ["All", "Men", "Women", "Kids"],
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the rich-text editor.
      },
      dropzoneOptions: {
        url: `${APP_URL}/api/admin/product/${this.$route.params.product}/upload/images`,
        thumbnailWidth: 150,
        maxFilesize: 5.5,
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      },
      dropzoneOptionsForPackageProduct: {
        url: `${APP_URL}/api/admin/package/product/${this.$route.params.product}/upload/images`,
        thumbnailWidth: 150,
        maxFilesize: 5.5,
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
      },
      categories: [],
      subCategories: [],
      formData: {
        product_type: null,
        product_id: null,
        name: null,
        category_id: null,
        short_des: null,
        order_note: null,
        full_des: null,
        sub_category_id: null,
        productImages: null,
        market_price: null,
        offer_price: 0,
        is_offer_expirable: false,
        expire_date_timestamp: null,
        expire_date: null,
        product_image: null,
        product_channel: null,
        product_variation: [],
      },
      newProductVariation: null,
      variationOption: {
        variation_index: null,
        variation_id: null,
        name: null,
        price: null,
      },
      errors_exist: false,
      formErrors: [],
    };
  },
  created() {
    this.isLoading = true;
    this.getCategories();
    this.getProduct(this.$route.params.product);
  },
  methods: {
    addProductVariation() {
      axios
        .post(
          `${APP_URL}/api/admin/product/${this.$route.params.product}/variation`,
          { variation: this.newProductVariation }
        )
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.product_variation.push(res.data.variation);
            this.showProductVariationModal = false;
            this.newProductVariation = null;
            this.refresh();
          } else {
            Alert.showErrorAlert("Failed");
          }
        })
        .catch((err) => console.log(err));
    },
    addProductVariationOption() {
      axios
        .post(
          `${APP_URL}/api/admin/product/${this.$route.params.product}/variation/option`,
          this.variationOption
        )
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.product_variation[
              this.variationOption.variation_index
            ].options.push(res.data.variationOption);
            this.showProductVariationOptionModal = false;
            this.variationOption.variation_index = null;
            this.variationOption.variation_id = null;
            this.variationOption.name = null;
            this.variationOption.price = null;
          } else {
            Alert.showErrorAlert("Failed");
          }
        })
        .catch((err) => console.log(err));
    },
    deleteProductVariationOption(variationIndex, variationOptionIndex) {
      let option =
        this.formData.product_variation[variationIndex].options[
          variationOptionIndex
        ];
      axios
        .delete(`${APP_URL}/api/admin/product/${option.id}/variation/option`)
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.product_variation[variationIndex].options.splice(
              variationOptionIndex,
              1
            );
          } else {
            Alert.showErrorAlert("Failed");
          }
        })
        .catch((err) => console.log(err));
    },
    addVariationOption(index) {
      this.variationOption.variation_id =
        this.formData.product_variation[index].id;
      this.variationOption.variation_index = index;
      this.showProductVariationOptionModal = true;
    },
    deleteProductVariation(variationIndex) {
      let variation = this.formData.product_variation[variationIndex];
      axios
        .delete(`${APP_URL}/api/admin/product/${variation.id}/variation`)
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.product_variation.splice(variationIndex, 1);
          } else {
            Alert.showErrorAlert("Failed");
          }
        })
        .catch((err) => console.log(err));
    },
    refresh() {
      this.getProduct(this.$route.params.product);
    },
    removeProductImage(imageIndex) {
      this.$swal({
        title: "Delete this record?",
        text: "Are you sure? You won't be able to revert this!",

        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete it!",
      }).then((result) => {
        // <--
        if (result.value) {
          // <-- if confirmed
          this.deleteConfirmationProductImage(imageIndex);
        }
      });
    },
    deleteConfirmationProductImage(imageIndex) {
      let image = this.formData.productImages[imageIndex];
      axios
        .post(`${APP_URL}/api/admin/product-image/${image.imageId}/delete`)
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.productImages.splice(imageIndex, 1);
            Alert.showSuccessAlert(res.data.message);
          } else {
            Alert.showErrorAlert(res.data.message);
          }
        })
        .catch((err) => console.log(err));
    },
    removeSliderImage(imageIndex) {
      this.$swal({
        title: "Delete this record?",
        text: "Are you sure? You won't be able to revert this!",

        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete it!",
      }).then((result) => {
        // <--
        if (result.value) {
          // <-- if confirmed
          this.deleteConfirmationSliderImage(imageIndex);
        }
      });
    },
    deleteConfirmationSliderImage(imageIndex) {
      let image = this.formData.productSlideImages[imageIndex];
      axios
        .post(`${APP_URL}/api/admin/product-image/${image.imageId}/delete`)
        .then((res) => {
          if (res.data.status === 200) {
            this.formData.productSlideImages.splice(imageIndex, 1);
            Alert.showSuccessAlert(res.data.message);
          } else {
            Alert.showErrorAlert(res.data.message);
          }
        })
        .catch((err) => console.log(err));
    },
    getProduct(product) {
      axios
        .get(`${APP_URL}/api/admin/product/${product}`)
        .then((res) => {
          this.isLoading = false;
          this.formData = res.data.product;
          this.formData.category_id = res.data.product.categoryData.id;
          this.formData.expire_date = res.data.product.expire_date_timestamp;
          this.formData.sub_category_id = res.data.product.subCategoryData.id;
          this.getSubCategories(this.formData.category_id);
        })
        .catch((err) => console.log(err));
    },
    getCategories() {
      axios
        .get(`${APP_URL}/api/admin/category`)
        .then((res) => {
          this.categories = res.data.categories;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    getSubCategories() {
      if (this.formData.category_id != null) {
        axios
          .get(
            `${APP_URL}/api/admin/category/${this.formData.category_id}/sub-categories`
          )
          .then((res) => {
            this.subCategories = res.data.subCategories;
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    // to add a new category
    saveFormData() {
      // add new category
      axios
        .patch(
          `${APP_URL}/api/admin/product/${this.$route.params.product}`,
          this.formData
        )
        .then((res) => {
          if (!res.data.errors) {
            if (res.data.status === 200) {
              Alert.showSuccessAlert(res.data.message);
              // this.$router.push({name: 'products'})
            } else {
              Alert.showErrorAlert(res.data.message);
            }
          } else {
            this.errors_exist = true;
            this.formErrors = res.data.errors || {};
            Alert.showErrorAlert(res.data.message);
          }
        })
        .catch((error) => {});
    },
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.formData.product_image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
  },
  computed: {
    validationErrors() {
      let errors = Object.values(this.formErrors);
      errors = errors.flat();
      return errors;
    },
  },
};
</script>
<style scoped>
.vue-dropzone {
  border: 2px dotted #d5d5d5;
  padding: 40px;
}

.removeAttchedImage {
  cursor: pointer;
}

.removeAttachedImage {
  display: flex;
}

.removeAttachedImage .image {
  margin-right: 10px;
  cursor: pointer;
}

div#kt_select_modal {
  background: #18171775;
}

div#kt_opion_modal {
  background: #18171775;
}

img {
  object-fit: cover;
}
</style>
