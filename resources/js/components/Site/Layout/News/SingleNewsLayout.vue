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
    width: 18rem;
    /*max-height: ;*/
    height: 15rem;
}

.news-title {
    font-size: 20px;
    text-align: center;
    margin: 0px;
    margin-top: 20px !important;
    height: 4rem;
    overflow: hidden;
}

.news-content {
    margin-top: 22px;
    text-align: center;
    height: 5rem;
    overflow:hidden;
}

</style>
