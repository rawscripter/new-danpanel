<template>
    <div class="news-single shadow text-center">
        <img class="news-image"
             alt="news image"
             :src='`/news/images/${news.image}`'>
        <div>
            <div class="news-title">{{ news.title }}</div>

            <div class="news-content" v-html="news.description">
            </div>

            <div class="news-button mt-5">
                <router-link :to="{name:'news-details',params:{news:news.slug}}" class="btn btn-theme btn-block">Læs
                    mere
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleNewsLayout",
    props: ['news']
}
</script>

<style scoped>
.news-image {
    max-width: 100%;
    /*max-height: ;*/
    max-height: 245px;
}

.news-title {
    font-size: 20px;
    text-align: center;
    margin: 0px;
    margin-top: 20px !important;
}

.news-content {
    margin-top: 22px;
    text-align: center;
    max-height: 110px;
    overflow: hidden;
}

</style>
