<template>
<div class="container mt-5 pt-5">
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{article.title.toUpperCase()}}</h2>
                            <!-- <p>{{article.category.name}} <span>- {{article.created_at}}</span></p> -->
                        </div>
                        <div class="blog-large-pic">
                            <img :src="'/images/article/' + article.photo" alt="">
                        </div>
                        <div v-html="article.content" class="blog-detail-desc"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
</div>
</template>

<script>
export default {
    data() {
        return {
            article: {
                title: '',
                photo: '',
                content: '',
            },
        };
    },
    methods: {
        getArticle() {
            axios.get("/api/article/" + this.$route.params.slug)
                .then(({
                    data
                }) => {
                    if (!data[0])
                        this.$router.push('/'); // redirect if article not exist
                    this.article = data[0];
                });
        }
    },
    mounted() {
        this.getArticle();
    }
}
</script>
