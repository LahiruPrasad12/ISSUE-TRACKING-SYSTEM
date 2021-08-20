<template>

<div>



<div id="navbar">
  <a id="logo" href="#default">10QBIT COMPANY</a>
  <div id="navbar-right">
    <nuxt-link to="/" class="active">Home</nuxt-link>
    <nuxt-link to="/categories/allcategories">All Categories</nuxt-link>
      <nuxt-link to="/issues/allisuue">All Issues</nuxt-link>
     <nuxt-link to="/contact">Contact us</nuxt-link>
     <nuxt-link to="/about">About us</nuxt-link>
  </div>
</div>
 <Nuxt />
</div>
</template>


<script>

export default {
fetch(){
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "30px 10px";
    document.getElementById("logo").style.fontSize = "25px";
  } else {
    document.getElementById("navbar").style.padding = "80px 10px";
    document.getElementById("logo").style.fontSize = "35px";
  }
}
}
}
</script>



<style scoped>

#navbar {
  background-color: #333;
  overflow: hidden;
  padding: 90px 10px; /* Large padding which will shrink on scroll (using JS) */
  transition: 0.4s; /* Adds a transition effect when the padding is decreased */
  position: fixed; /* Sticky/fixed navbar */
  width: 100%;
  top: 0; /* At the top */
  z-index: 99;
}
#navbar a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 18px;
}

#navbar #logo {
  font-size: 35px;
  font-weight: bold;
  transition: 0.4s;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link */
#navbar a.active {
  background-color: #04AA6D;
  color: white;
}

/* Display some links to the right */
#navbar-right {
  float: right;
}

/* Add responsiveness - on screens less than 580px wide, display the navbar vertically instead of horizontally */
@media screen and (max-width: 580px) {
  #navbar {
    padding: 20px 10px !important; /* Use !important to make sure that JavaScript doesn't override the padding on small screens */
  }
  #navbar a {
    float: none;
    display: block;
    text-align: left;
  }
  #navbar-right {
    float: none;
  }
}


</style>
