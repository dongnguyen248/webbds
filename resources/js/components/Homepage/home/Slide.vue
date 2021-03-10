<template>
    <carousel v-bind="setting" class="slide-home" v-if="slides.length > 0">
        <div
            class="single-hero-items"
            :style="{
                'background-image': 'url(/images/slide/' + slide + ')'
            }"
            v-for="(slide,i) in slides"
            :key="i"
        ></div>
    </carousel>
</template>

<script>
import carousel from "vue-owl-carousel";

export default {
    components: {
             carousel

    },
    data() {
           return {
            slides: [
                'slide1.jpg',
                'slide2.jpg',
                'slide3.jpg',
                'slide4.jpg',
                'slide5.jpg',
                'slide6.jpg'
            ],
            setting: {
                loop: true,
                margin: 0,
                nav: true,
                items: 1,
                dots: false,
                animateOut: "fadeOut",
                animateIn: "fadeIn",
                navText: [
                    '<i class="ti-angle-left"></i>',
                    '<i class="ti-angle-right"></i>'
                ],
                smartSpeed: 1200,
                autoHeight: false,
                autoplay: true
            }
        };
    },

}
</script>
<style scoped>
.slide-home .owl-nav div[class*="owl-"] {
    font-size: 30px;
    position: absolute;
    left: 40px;
    top: 45%;
    color: #252525;
    background: none;
}

.slide-home .owl-nav div[class*="owl-"]:hover {
    color: #dfad51;
    background: none;
}

.slide-home .owl-nav div.owl-next {
    left: auto;
    right: 40px;
}
.single-hero-items {
    height: 510px;
    padding-top: 210px;
}

.single-hero-items span {
    color: #e7ab3c;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    line-height: 28px;
    display: inline-block;
    position: relative;
    top: 50px;
    opacity: 0;
}

.single-hero-items h1 {
    color: #252525;
    font-size: 72px;
    font-weight: 700;
    margin-bottom: 6px;
    position: relative;
    top: 50px;
    opacity: 0;
}

.single-hero-items p {
    margin-bottom: 42px;
    position: relative;
    top: 100px;
    opacity: 0;
}

.single-hero-items .primary-btn {
    position: relative;
    top: 100px;
    opacity: 0;
}
</style>
