import Home from "./components/Homepage/home/Trangchu.vue";
import Login from "./components/Admin/Auth/Login.vue";
import Category from "./components/Admin/Categories.vue";
import Type from "./components/Admin/Type.vue";
import Article from "./components/Admin/Article.vue";
import Contact from "./components/Homepage/home/Lienhe.vue"
import ArticleDetail from "./components/Homepage/home/DetailArticle.vue";
import TypeFilter from "./components/Homepage/home/TypeFilter.vue";
// import CategoryFilter from "./components/Homepage/home/CategoryFilter.vue"
const routes = [{
        path: "/",
        component: Home,
    },
    {
        path: '/lien-he',
        component: Contact,
        name: 'contact'
    },

    {
        path: "/type-filter/:typeTitle",
        component: TypeFilter,
        name: "TypeFilter"
    },
    {
        path: "/article-detail/:slug",
        component: ArticleDetail,
        name: "articledetail"
    },


    //adminpage 
    {
        path: "/login",
        component: Login
    },
    {
        path: "/adminpage",
        meta: {
            requiresAuth: true

        },
        component: Category

    },
    {
        path: "/category",
        meta: {
            requiresAuth: true

        },
        component: Category

    },

    {
        path: "/type",
        meta: { requiresAuth: true },
        component: Type,
    },
    {
        path: "/article",
        meta: { requiresAuth: true },
        component: Article
    }

];
export { routes };