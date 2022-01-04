<template>
  <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
    <div class="col-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">All Blogs</h3>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="table-responsivess">
            <v-server-table
              ref="myTable"
              url="/api/admin/blog"
              :columns="columns"
              :options="options"
            >
              <span slot="image" slot-scope="{ row }">
                <img
                  class="img-fluid"
                  :src="`/blog/images/${row.image}`"
                  width="100"
                  alt="Image"
                />
              </span>
              <span slot="actions" slot-scope="{ row }">
                <div class="btn-group">
                  <button
                    class="btn btn-sm btn-primary"
                    v-on:click="edit(row.id)"
                  >
                    Edit
                  </button>
                  <button
                    v-on:click="deleteBlog(row.id)"
                    class="btn btn-sm btn-danger"
                  >
                    Delete
                  </button>
                </div>
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
  name: "BlogsIndex",
  data() {
    return {
      productStatus: null,
      columns: ["id", "image", "title", "short_des", "created_at", "actions"],
      options: {
        headings: {
          id: "ID",
          image: "Image",
          title: "Title",
          short_des: "Description",
          created_at: "Created At",
          actions: "actions",
        },
        perPage: 10,
        perPageValues: [10, 20, 25, 50, 100],
        sortable: ["name"],
        filterable: ["name"],
        responseAdapter: function (resp) {
          return {
            data: resp.data.blogs,
            count: resp.data.total,
          };
        },
      },
    };
  },
  methods: {
    edit(blogID) {
      this.$router.push({
        name: "blog.edit",
        params: { blog: blogID },
      });
    },
    deleteBlog(blogID) {
      this.$swal({
        title: "Delete this record?",
        text: "Are you sure? You won't be able to revert this!",
        type: "warning",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Archive it!",
      }).then((result) => {
        // <--
        if (result.value) {
          // <-- if confirmed
          this.deleteConfirmation(blogID);
        }
      });
    },
    deleteConfirmation(blogID) {
      axios
        .delete(`${APP_URL}/api/admin/blog/${blogID}`)
        .then((res) => {
          Alert.showSuccessAlert(res.data.message);
          this.$refs.myTable.refresh();
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style>
.VueTables__search-field {
  display: flex !important;
}

.VueTables__search-field label,
.VueTables__limit-field label {
  margin-right: 10px;
}

.VueTables__limit-field {
  display: flex !important;
}
</style>
