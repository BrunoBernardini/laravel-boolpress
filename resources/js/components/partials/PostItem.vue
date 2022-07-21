<template>
  <div class="post">
    <h3>
        <router-link :to="{name: 'detail', params:{slug: post.slug}}">{{post.title}}</router-link>
    </h3>
    <i>{{postDate}}</i>
    <p>{{postContent}}</p>
  </div>
</template>

<script>
export default {
    name: "PostItem",
    props: {
        post: Object,
    },
    computed: {
        postDate(){
            const tempDate = new Date(this.post.updated_at);
            let postDay = tempDate.getDate();
            if(postDay<10) postDay = "0"+postDay;
            let postMonth = tempDate.getMonth()+1;
            if(postMonth<10) postMonth = "0"+postMonth;
            const postYear = tempDate.getFullYear();
            return postDay+"/"+postMonth+"/"+postYear;
        },
        postContent(){
            return this.post.content.substr(0, 50)+"..."
        }
    }
}
</script>

<style lang="scss" scoped>
.post{
    margin-bottom: 15px;
    a{
        color: inherit;
        text-decoration: none;
        &:hover{
            color: wheat;
            text-decoration: underline;
        }
    }
}
</style>
