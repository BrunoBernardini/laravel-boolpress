<template>
  <div class="container">
    <LoaderComp v-if="!posts"/>
    <section class="posts-container" v-else>
        <h1>Tutti i post {{searchType}}</h1>
        <PostItem
            v-for="post in posts"
            :key="'post'+post.id"
            :post="post"/>
        <section
            class="pagination"
            v-if="showPagination">
            <button
                @click="getApi(pagination.current-1)"
                :disabled="pagination.current === 1">&lt;</button>
            <button
                v-for="pageIndex in pagination.last"
                :key="'page'+pageIndex"
                @click="getApi(pageIndex)"
                :disabled="pagination.current === pageIndex">
                {{pageIndex}}
            </button>
            <button
                @click="getApi(pagination.current+1)"
                :disabled="pagination.current === pagination.last">></button>
        </section>
    </section>
    <SideBar
        :categories="categories"
        :tags="tags"
        @searchPostsByCategory="searchPostsByCategory"
        @searchPostsByTag="searchPostsByTag"
        @searchAllPosts="getApi(1)"/>
  </div>
</template>

<script>
import PostItem from "../partials/PostItem.vue";
import LoaderComp from "../partials/LoaderComp.vue";
import { apiUrl } from "../../data/config";
import SideBar from "../partials/SideBar.vue";

export default {
    name: "BlogComp",
    components: {
        PostItem,
        LoaderComp,
        SideBar
    },
    data() {
        return {
            apiUrl,
            posts: null,
            pagination: {
                current: null,
                last: null
            },
            showPagination: false,
            categories: [],
            tags: [],
            searchType: ""
        };
    },
    mounted() {
        this.getApi(1);
    },
    methods: {
        getApi(page) {
            this.searchType = "";
            this.posts = null;
            axios.get(this.apiUrl + "?page=" + page)
                .then(res => {
                this.posts = res.data.posts.data;
                this.pagination = {
                    current: res.data.posts.current_page,
                    last: res.data.posts.last_page
                }
                this.showPagination = true;
                this.categories = res.data.categories;
                this.tags = res.data.tags;
            });
        },
        searchPostsByCategory(category_slug){
            this.searchPostsFiltered("/post-category/", category_slug);
        },
        searchPostsByTag(tag_slug){
            this.searchPostsFiltered("/post-tag/", tag_slug);
        },
        searchPostsFiltered(uri, slug){
            this.posts = null;
            axios.get(this.apiUrl + uri + slug)
                .then(res => {
                    this.searchType = res.data.name;
                    this.posts = res.data.posts;
                    this.showPagination = false;
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.container{
    display: flex;
}
.posts-container{
    flex-basis: 70%;
    h1{
        margin-bottom: 20px;
    }
    button{
        padding: 5px;
    }
}
</style>
