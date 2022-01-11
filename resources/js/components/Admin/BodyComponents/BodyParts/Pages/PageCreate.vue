<template>
  <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
    <div class="col-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">Add New Page</h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <!--begin: Datatable -->
          <form @submit.prevent="saveFormData">
            <div class="form-group row">
              <div class="col-md-12">
                <label class="col-form-label">Page Title:</label>
                <input
                  required
                  v-model="formData.title"
                  class="form-control"
                  for="category_name"
                  type="text"
                />
              </div>
              <div class="col-md-12 mt-4 mb-4">
                <div class="form-check">
                  <input
                    v-model="formData.show_at_top_menu"
                    class="form-check-input"
                    type="checkbox"
                    name="show_at_top_menu"
                    id="show_at_top_menu"
                    value="1"
                  />
                  <label class="form-check-label" for="show_at_top_menu"
                    >Show In Top Menu</label
                  >
                </div>
              </div>
              <div class="col-md-12 mb-4">
                <div class="form-check">
                  <input
                    v-model="formData.show_at_bottom_menu"
                    class="form-check-input"
                    type="checkbox"
                    name="show_at_bottom_menu"
                    id="show_at_bottom_menu"
                    value="1"
                  />
                  <label class="form-check-label" for="show_at_bottom_menu"
                    >Show In Footer Menu</label
                  >
                </div>
              </div>

              <div class="col-md-12">
                <label for="full_des" class="col-form-label"
                  >Description:</label
                >

                <ckeditor
                  :editor="editor"
                  v-model="formData.content"
                  :config="editorConfig"
                ></ckeditor>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="product_image" class="col-form-label"
                    >Page Image:</label
                  >
                  <div class="text-center m-2" v-if="formData.image">
                    <img
                      :src="formData.image"
                      class="img-responsive"
                      width="250px"
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
            </div>

            <div class="form-group row mt-2">
              <div class="col-12">
                <input
                  class="btn btn-block btn-primary"
                  type="submit"
                  value="Add New Page"
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
      editorConfig: {},
      newProductVariation: null,
      formData: {
        title: "",
        content: "",
        image: "",
        show_at_bottom_menu: 0,
        show_at_top_menu: 0,
      },
      errors_exist: false,
      formErrors: [],
    };
  },

  methods: {
    // to add a new category
    saveFormData() {
      // add new product
      axios
        .post(`${APP_URL}/api/admin/page/store`, this.formData)
        .then((res) => {
          if (!res.data.errors) {
            Alert.showSuccessAlert(res.data.message);
            this.$router.push({ name: "pages" });
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

