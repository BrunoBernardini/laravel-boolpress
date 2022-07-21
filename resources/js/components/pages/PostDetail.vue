<template>
    <div class="container">
        <h1>{{post.title}}</h1>
        <h3>{{post.category.name}}</h3>
        <section class="tags">
            <span
                class="tag"
                v-for="tag in post.tags"
                :key="tag.id">{{tag.name}} </span>
        </section>
        <p>{{post.content}}</p>
    </div>
</template>

<script>
import { apiUrl } from "../../data/config";

export default {
    name: "PostDetail",
    data(){
        return {
            apiUrl,
            post: {
                title: "",
                content: "",
                category: "",
                tags: []
            },
        }
    },
    mounted(){
        this.getApi();
    },
    methods: {
        getApi(){
            axios.get(this.apiUrl+"/"+this.$route.params.slug)
                .then(res=>{
                    this.post = res.data;
                })
        }
    }
}
</script>

<style>
h1{
    margin-bottom: 20px;
}
.tag{
    display: inline-block;
    background-color: gold;
    color: black;
    padding: 3px 7px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    margin: 10px 5px 10px 0;
}
</style>
