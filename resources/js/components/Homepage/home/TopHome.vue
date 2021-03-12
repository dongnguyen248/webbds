<template>
<div>
    <div class="right w-clear" v-for="category in categories" :key="category.id">
        <div v-if="category.type.length >0">
            <div class="title_main">
                <span>{{category.name}}</span>
            </div>
            <div class="content_main align-content w-clear">
                <div class="projectbds" v-for="t in category.type" :key="t.id">
                    <div class="pic_project">
                        <a :href="'/type-filter/' + t.slug">
                            <img class="transition" alt="" :src="'/images/types/' + t.photo">
                        </a>
                        <div class="info-project">
                            <a :href="'/type-filter/' + t.slug">
                                {{t.name}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
            categories: []
        }
    },
    methods: {
        getCategories() {
            axios.get('https://www.vinhomesmiennam.net/api/category').then(response => {
                this.categories = response.data.allcategories;
            })
        },
    },
    mounted() {
        this.getCategories();
    }
}
</script>

<style scoped>
.content_main {
    max-width: 1200px;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
}

.title_main {
    margin-bottom: 35px;
    text-align: center;
    padding-bottom: 25px;
    background: url(/images/bg-title-main.png) no-repeat bottom center;
}

.title_main span {
    font-size: 28px;
    color: #ff0000;
    font-weight: normal;
    text-transform: uppercase;
    font-family: Tahoma;
    font-weight: bold;
}

.projectbds:nth-of-type(3n+1) {
    clear: both;
}

.projectbds {
    width: 350px;

    margin-right: 24px;
    margin-bottom: 30px;
}

.pic_project {
    position: relative;
    overflow: hidden;
}

.pic_project img:hover {
    transform: scale(1.1);
    -o-transform: scale(1.1);
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
}

.transition {
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
}

.info-project {
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 100%;
    padding: 7px 5px;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, .9));
    text-align: left;
}

.info-project a {
    font-family: 'Tahoma';
    font-size: 18px;
    color: #fff;
    font-weight: bold;
    line-height: 21px;
    width: 100%;
    transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
}

.info-project a:hover {
    color: yellow;
}

.more-button-box {
    text-align: center;
    margin: 20px 0px 20px 0px;
}

.more-button-box a {
    display: inline-block;
    padding: 8px 30px 10px 30px;
    color: #fff;
    font-size: 17px;
    font-family: 'Tahoma';
    background: #303339;
}

.right {
    width: 100%;
}

.more-button-box a:hover {
    background: #c72528;
}
</style>
