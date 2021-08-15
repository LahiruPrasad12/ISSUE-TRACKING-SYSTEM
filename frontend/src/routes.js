import Vue from 'vue'
import VueRouter from "vue-router";
import Allissues from "./components/Issues/Allissues";
import AboutUs from "./components/layout/AboutUs";
import Allcategories from "./components/Categories/Allcategories";
import ContactUs from "./components/layout/ContactUs";
import Subcaregories from "./components/Categories/Subcaregories";
import Comment from "./components/Comments/Comment";





Vue.use(VueRouter);


const router = new VueRouter({

  mode:"history",

  routes:[
    {path:"/" ,component:Allcategories},
    {path:"/category" ,component:Allcategories},
    {path:"/issue" ,component:Allissues},
    {path:"/subcategory/:id" ,component:Subcaregories},
    {path:"/add" ,component:Allissues},
    {path:"/comment/:id" ,component:Comment},
    {path:"/contact" ,component:ContactUs},
    {path:"/about", component:AboutUs}

  ]
});

export default router;
