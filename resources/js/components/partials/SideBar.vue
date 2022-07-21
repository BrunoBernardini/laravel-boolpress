<template>
  <div>
    <section>
        <h3>Categorie</h3>
        <ul>
            <li
                v-for="category in categories"
                :key="'category'+category.id"
                @click="$emit('searchPostsByCategory', category.slug)">
                {{category.name}}
            </li>
        </ul>
    </section>
    <section>
        <h3>Tags</h3>
        <ul>
            <li
                v-for="tag in tags"
                :key="'tag'+tag.id"
                @click="$emit('searchPostsByTag', tag.slug)">
                {{tag.name}}
            </li>
        </ul>
    </section>
    <section>
        <ul>
            <li
                @click="$emit('searchAllPosts')">Tutti i post</li>
        </ul>
    </section>
  </div>
</template>

<script>
export default {
    name: "SideBar",
    props: {
        categories: Array,
        tags: Array
    }
}
</script>

<style lang="scss" scoped>
section{
    margin-bottom: 20px;
    ul{
        list-style: none;
        li{
            cursor: pointer;
            &:hover{
                text-decoration: underline;
            }
        }
    }
}
</style>
