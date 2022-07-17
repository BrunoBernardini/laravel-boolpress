<template>
  <header>
    <nav>
        <ul>
            <li>
                <router-link
                :to="{name: 'home'}">Home</router-link>
            </li>
            <li>
                <router-link
                :to="{name: 'blog'}">Blog</router-link>
            </li>
            <li>
                <router-link
                :to="{name: 'about'}">Chi siamo</router-link>
            </li>
            <li>
                <router-link
                :to="{name: 'contacts'}">Contatti</router-link>
            </li>
        </ul>
    </nav>
  </header>
</template>

<script>
export default {
    name: "HeaderComp"
}
</script>

<style lang="scss" scoped>

header{
    background-color: goldenrod;
    padding: 20px;
    height: 70px;
    ul{
        list-style: none;
        text-align: center;
        li{
            display: inline-block;
            a{
                color: white;
                text-decoration: none;
                margin: 0 10px;
                &:hover{
                    text-decoration: underline;
                }
                &.active{
                    color: darkred;
                }
            }
        }
    }
}

</style>
