<template>
<div>
    <div class="title_main">
        <span>CÁC BÀI PHÂN TÍCH NỔI BẬT</span>
    </div>
    <div class="media-container-row">

        <div class="card p-3 col-12 col-md-6 col-lg-4">
            <div class="card-wrapper">
                <div class="card-img">
                    <img src="/images/news/526755958808.jpg" alt="Mobirise" media-simple="true">
                </div>
                <div class="card-box">
                    <h4 class="card-title mbr-fonts-style display-7">
                        No Coding
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Mobirise is an easy website builder - just drop site elements to your page, add content and style it to look the way you like.
                    </p>
                </div>
                <div class="mbr-section-btn text-center">
                    <a href="https://mobirise.com" class="btn btn-primary display-4">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <div class="card p-3 col-12 col-md-6 col-lg-4">
            <div class="card-wrapper">
                <div class="card-img">
                    <img src="/images/news/526755958808.jpg" alt="Mobirise" media-simple="true">
                </div>
                <div class="card-box">
                    <h4 class="card-title mbr-fonts-style display-7">
                        Mobile Friendly
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                        All sites you make with Mobirise are mobile-friendly. You don't have to create a special mobile version of your site.
                    </p>
                </div>
                <div class="mbr-section-btn text-center">
                    <a href="https://mobirise.com" class="btn btn-primary display-4">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <div class="card p-3 col-12 col-md-6 col-lg-4">
            <div class="card-wrapper">
                <div class="card-img">
                    <img src="/images/news/526755958808.jpg" alt="Mobirise" media-simple="true">
                </div>
                <div class="card-box">
                    <h4 class="card-title mbr-fonts-style display-7">
                        Unique Styles
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Mobirise offers many site blocks in several themes, and though these blocks are pre-made, they are flexible.
                    </p>
                </div>
                <div class="mbr-section-btn text-center">
                    <a href="https://mobirise.com" class="btn btn-primary display-4">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            articles:[],

        }
    },
    methods:{
        getArticle(){
            axios.get('api/article').then(response=>{
                this.articles = response.data.allarticle
            });
        }
    }
}
</script>
<style scoped>
.media-container-row {
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-align-content: center;
    -ms-flex-line-pack: center;
    align-content: center;
    -webkit-align-items: start;
    -ms-flex-align: start;
    align-items: start;
}
</style>
