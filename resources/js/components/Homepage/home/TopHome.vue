<template>
<div class="contain_main w-clear">
    <div class="right w-clear">
        <div class="title_main">
            <span>Dự án nổi bật</span>
        </div>
        <div class="content_main align-content w-clear">
            <div class="projectbds" v-for="type in types" :key="type.id">
                <div class="pic_project">
                    <a :href="'/type-filter/' + type.slug" >
                        <img class="transition" alt="" :src="'/images/types/' + type.photo">
                    </a>
                    <div class="info-project">
                        <router-link  href="#">
                            {{type.name}} 
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="more-button-box"><a href="#" class="transition">Xem tất cả</a></div>
        </div>
    </div>

</div>
</template>
<script>
export default {
    data(){
        return{
            types:[]
        }
    },
    methods:{
        getTypes(){
            axios.get('api/type').then(response=>{
                this.types = response.data.alltype;
            })
        }
    },
    mounted(){
        this.getTypes();
    }
}
</script>
<style scoped>
.contain_main {
    max-width: 1200px;
    margin: 30px auto;
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
    float: left;
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


.right{
    width: 100%;
}
.more-button-box a:hover {
    background: #c72528;
}
</style>
