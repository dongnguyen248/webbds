<template>
<div>
    <main-header></main-header>
    <router-view></router-view>
    <main-footer></main-footer>
</div>

</template>
<script>
import MainFooter from './Footer.vue';
import MainHeader from './Header.vue';
export default {
    components:{
        'main-footer':MainFooter,
        'main-header':MainHeader
       
    }
}
</script>
