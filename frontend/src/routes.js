import Vue from 'vue'
import VueRouter from "vue-router";
import Allissues from "./components/Issues/Allissues";
import AboutUs from "./components/layout/AboutUs";
import Allcategories from "./components/Categories/Allcategories";
import ContactUs from "./components/layout/ContactUs";
import Subcaregories from "./components/Categories/Subcaregories";





Vue.use(VueRouter);


const router = new VueRouter({

  mode:"history",

  routes:[
    {path:"/" ,component:Allcategories},
    {path:"/allCat" ,component:Allcategories},
    {path:"/subcategory/:id" ,component:Subcaregories},
    {path:"/add" ,component:Allissues},
    {path:"/contact" ,component:ContactUs},
    {path:"/about", component:AboutUs}

  ]
});

export default router;
