<template>
    <div>
        <div class="card  border-0" v-if="!isLoading">
            <div class="card-body shadow border-0">
                <div class="sub-category-title p-2" v-for="cat in subCategories" :key="cat.id"
                     @click="filterBlogByCategory(cat.id)">
                    {{ cat.name }} ({{ cat.blogs_count }})
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogSideBar",
    data() {
        return {
            subCategories: [],
            isLoading: false
        }
    },
    methods: {
        getBlogsCategories() {
            axios.get(`${APP_URL}/api/get/blog/sub-categories`).then((res) => {
                this.subCategories = res.data.data;
                this.isLoading = false;
            });
        },
        filterBlogByCategory(id) {
            this.$emit('filterBlogByCategory', id);
        }
    },
    created() {
        this.getBlogsCategories();
    }
}
</script>

<style scoped>
.sub-category-title {
    color: #7b7b7b;
    font-weight: bold;
    cursor: pointer;
}

.sub-category-title:hover {
    text-decoration: underline;
}
</style>
