<template>
  <div class="container post-container">
    <h1>Tutti i post</h1>
    <PostItem
        v-for="post in posts"
        :key="post.id"
        :post="post"/>
    <button
        @click="getApi(pagination.current-1)"
        :disabled="pagination.current === 1">&lt;</button>
    <button
        v-for="pageIndex in pagination.last"
        :key="'page'+pageIndex"
        @click="getApi(pageIndex)"
        :disabled="pagination.current === pageIndex">{{pageIndex}}</button>
    <button
        @click="getApi(pagination.current+1)"
        :disabled="pagination.current === pagination.last">></button>
  </div>
</template>

<script>
import PostItem from "../partials/PostItem.vue";

export default {
    name: "BlogComp",
    components: {
        PostItem,
    },
    data() {
        return {
            apiUrl: "/api/posts",
            posts: null,
            pagination: {
                current: null,
                last: null
            }
        };
    },
    mounted() {
        this.getApi(1);
    },
    methods: {
        getApi(page) {
            axios.get(this.apiUrl + "?page=" + page)
                .then(res => {
                this.posts = res.data.data;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page
                }
            });
        }
    },
    components: { PostItem }
}
</script>

<style lang="scss" scoped>
.post-container{
    h1{
        margin-bottom: 20px;
    }
    button{
        padding: 5px;
    }
}
</style>
