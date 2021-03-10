<template>
<div >
    <main-slide></main-slide>
    <top-home class="container"></top-home>
    <midle-home class="container"></midle-home>
    <bottom-home></bottom-home>

</div>
</template>
<script>
import TopHome from './TopHome.vue';
import MidleHome from './MidleHome.vue';
import BottomHome from './BottomHome';
import MainSlide from './Slide.vue';

export default {
    components:{
        'top-home':TopHome,
        'midle-home':MidleHome,
        'bottom-home':BottomHome,
         'main-slide':MainSlide
    }
}
</script>
