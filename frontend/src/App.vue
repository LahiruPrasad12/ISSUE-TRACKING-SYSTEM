<template>
  <div id="app">
    <NavBar/>
    <router-view/>

  </div>
</template>

<script>

import NavBar from "./components/layout/NavBar";


export default {
  components: {
    "NavBar" : NavBar
  }

}
</script>

<style>

</style>
