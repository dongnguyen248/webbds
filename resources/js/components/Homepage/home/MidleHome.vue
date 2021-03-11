<template>
<div class="content_main align-content">
    <div class="title_main">
        <span>CÁC BÀI PHÂN TÍCH NỔI BẬT</span>
    </div>
    <div class="media-container-row">

        <div class="card p-3 col-12 col-md-6 col-lg-4 mr-3" v-for="article in articles" :key="article.id">
            <div class="card-wrapper">
                <div class="card-img">
                    <img :src="'/images/article/' + article.photo" alt="Mobirise" media-simple="true" class="img-thumbnail">
                </div>
                <div class="card-box">
                    <h4 class="card-title  display-7">
                        {{article.title.toUpperCase()}}
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7" v-html="article.content.substring(0,200)+'...'">
                    </p>
                </div>
                <div class="mbr-section-btn text-center">
                    <a :href="'/article-detail/' + article.slug" class="btn btn-primary display-4">
                        Read More
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            articles: [],

        }
    },
    methods: {
        getArticle() {
            axios.get('api/article').then(response => {
                this.articles = response.data.articles.data;
            });
        }
    },
    mounted() {
        this.getArticle();
    }
}
</script>

<style scoped>
.col-lg-4 {
    max-width: 31.333% ;

}
.contain_main {
    max-width: 1200px;
    margin: 30px auto;
}


.card-title {
    float: none;
    font-size: 2.1rem;
}

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
