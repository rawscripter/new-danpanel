<template>
    <div class="blog-single shadow">
        <img class="blog-image"
             alt="blog image"
             :src='`/blog/images/${blog.image}`'>
        <div>
            <router-link :to="{name:'blog-details',params:{blog:blog.slug}}" tag="span" class="cursour-pointer">
                <div class="blog-title">{{ blog.title }}</div>
            </router-link>

            <div class="blog-content" v-html="blog.description">
            </div>

            <div class="blog-button mt-5">
                <router-link :to="{name:'blog-details',params:{blog:blog.slug}}" class="btn btn-theme btn-block">Læs
                    mere
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleBlogLayout",
    props: ['blog']
}
</script>

<style scoped>
.blog-image {
    max-width: 100%;
}

.blog-title {
    font-size: 20px;
    text-align: center;
    margin: 0px;
    margin-top: 20px !important;
}

.blog-content {
    margin-top: 22px;
    text-align: center;
    max-height: 110px;
    overflow: hidden;
}

.blog-single.shadow {
    text-align: center;
}

img.blog-image {
    max-height: 245px;
}

.cursour-pointer {
    cursor: pointer;
}
</style>
