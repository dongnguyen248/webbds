<template>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        Menu
    </button>
    <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" >
          <li class="nav-item active">
                <a class="nav-link" href="/">TRANG CHỦ <span class="sr-only">(current)</span></a>
            </li> 
        </ul>
    </div>
    <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent" v-for="category in categories" :key="category.id">
        <ul class="navbar-nav mr-auto" v-if="category.type.length >0">
            <li class="nav-item dropdown">
                <a    class="nav-link dropdown-toggle" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{category.name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" v-for="t in category.type" :key="t.id"  :href="'/type-filter/' + t.slug">{{t.name}}</a>
                </div>
            </li>
       </ul>
        <ul class="navbar-nav mr-auto" v-else>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#"  role="button"  aria-haspopup="true" aria-expanded="false">
                    {{category.name}}
                </a>
            </li>
        </ul>

    </div>
</nav>
</template>

<script>
export default {
    data(){
        return{
            categories:[],
        }
    },
    methods: {
        getCategories() {
            axios.get('api/category').then(response=>{
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
.dropdown:hover>.dropdown-menu {
  display: block;
}
section {
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-size: cover;
}

.cid-qv1frvgcz3 .navbar {
    padding: .5rem 0;
    background: #f1f1f1;
    transition: none;
    min-height: 77px;
}

.bg-light {
    opacity: 0.7;
}

.navbar-light .navbar-nav .nav-link {
    color: #111 !important;
}

/* .container-sm{
  display: none ;
} */
</style>
