<template>
<div class="container mt-5 pt-5">
    <div class="title_main">
        <span>{{type.name.toUpperCase()}}</span>
    </div>
    <div class="media-container-row" v-for="(art, index) in type.article" :key="index">

        <div class="card p-3 col-12 col-md-6 col-lg-4">
            <div class="card-wrapper">
                <div class="card-img">
                    <img :src="'/images/article/' + art.photo" alt="Mobirise" media-simple="true">
                </div>
                <div class="card-box">
                    <h2 class="card-title display-7 mt-3">
                       {{art.title.toUpperCase()}}
                    </h2>
                    <p class="mbr-text mbr-fonts-style display-7" v-html="art.content.substring(0,200)+'...'">
                    </p>
                </div>
                <div class="mbr-section-btn text-center">
                    <a :href="'/article-detail/' + art.slug" class="btn btn-primary display-4">
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
    data(){
        return{
            type:[],
            categories:[]
        }
    },
    methods:{
        getTypeFillter(){
            axios.get('../api/type/'+ this.$route.params.typeTitle).then(({data})=>{
                this.type = data.typefil[0];
                console.log(data.typefil[0].name);
            })
        },
       
    },
    mounted(){
        this.getTypeFillter();
    }
}
</script>
<style  scoped>
.content_main {
    max-width: 1200px;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
}

.card-title{
    float: none;
    font-size: 2.1rem;


}
</style>
