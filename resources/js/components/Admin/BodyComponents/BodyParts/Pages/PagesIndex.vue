<template>
  <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
    <div class="col-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">All Pages</h3>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="table-responsivess">
            <v-server-table
              ref="myTable"
              url="/api/admin/pages"
              :columns="columns"
              :options="options"
            >
              <span slot="show_at_bottom_menu" slot-scope="{ row }">
                {{ row.show_at_bottom_menu ? "Yes" : "No" }}
              </span>

              <span slot="show_at_top_menu" slot-scope="{ row }">
                {{ row.show_at_top_menu ? "Yes" : "No" }}
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
              <span slot="link" slot-scope="{ row }">
                <a :href="row.link" target="_blank">{{ row.link }}</a>
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
  name: "PagesIndex",
  data() {
    return {
      productStatus: null,
      columns: [
        "id",

        "title",
        "link",
        "show_at_bottom_menu",
        "show_at_top_menu",
        "created_at",
        "actions",
      ],
      options: {
        headings: {
          id: "ID",

          title: "Title",
          link: "Page Link",
          show_at_bottom_menu: "Show In Footer Menu",
          show_at_top_menu: "Show In Footer Menu",
          created_at: "Created At",
          actions: "actions",
        },
        perPage: 10,
        perPageValues: [10, 20, 25, 50, 100],
        sortable: ["name"],
        filterable: ["name"],
        responseAdapter: function (resp) {
          return {
            data: resp.data.pages ?? [],
            count: resp.data.total,
          };
        },
      },
    };
  },
  methods: {
    edit(blogID) {
      this.$router.push({
        name: "page.edit",
        params: { page: blogID },
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
        .delete(`${APP_URL}/api/admin/page/${blogID}`)
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
