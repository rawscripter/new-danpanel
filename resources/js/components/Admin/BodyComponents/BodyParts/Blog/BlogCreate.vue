<template>
  <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
    <div class="col-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Add New Blog</h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <!--begin: Datatable -->
          <form @submit.prevent="saveFormData">
            <div class="form-group row">
              <div class="col-md-12">
                <label class="col-form-label">Blog Title:</label>
                <input
                  required
                  v-model="formData.title"
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
                    :key="category.id"
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
                  <option value>Select Category</option>
                  <option
                    v-for="subCategory in subCategories"
                    :key="subCategory.id"
                    v-bind:value="subCategory.id"
                  >
                    {{ subCategory.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-12">
                <label for="full_des" class="col-form-label"
                  >Description:</label
                >

                <ckeditor
                  :editor="editor"
                  v-model="formData.description"
                  :config="editorConfig"
                ></ckeditor>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="product_image" class="col-form-label"
                    >Blog Image:</label
                  >
                  <div class="text-center m-2" v-if="formData.image">
                    <img
                      :src="formData.image"
                      class="img-responsive"
                      width="250px"
                    />
                  </div>

                  <input
                    required
                    v-on:change="onImageChange"
                    class="form-control"
                    id="product_image"
                    type="file"
                  />
                </div>
              </div>
            </div>

            <div class="form-group row mt-2">
              <div class="col-12">
                <input
                  class="btn btn-block btn-primary"
                  type="submit"
                  value="Add New Blog"
                />
              </div>
            </div>
          </form>
          <!--end: Datatable -->

          <div v-if="errors_exist">
            <div
              v-for="(error, index) in validationErrors"
              :key="index"
              class="alert alert-outline-danger"
            >
              {{ error }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "ProductCreate",

  data() {
    return {
      editor: ClassicEditor,
      categories: [],
      subCategories: [],
      editorConfig: {
        // The configuration of the rich-text editor.
      },
      newProductVariation: null,
      formData: {
        title: "",
        description: "",
        image: "",
      },
      errors_exist: false,
      formErrors: [],
    };
  },
  created() {
    this.getCategories();
  },
  methods: {
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
      // add new product
      axios
        .post(`${APP_URL}/api/admin/blog/store`, this.formData)
        .then((res) => {
          if (!res.data.errors) {
            Alert.showSuccessAlert(res.data.message);
            this.$router.push({ name: "blogs" });
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
        vm.formData.image = e.target.result;
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

<style>
.active {
  display: block;
}
</style>

