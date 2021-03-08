<template>
  <div id="app">
    <div id="nav">
      <nav-bar />
      <!-- <router-link :to="{name: 'blog-list'}">Blog List</router-link> -->
    </div>
    <router-view />
  </div>
</template>

<script>
//import HelloWorld from './components/HelloWorld.vue'
//import Home from './views/Home.vue'
import NavBar from "./components/NavBar.vue";
export default {
  name: 'App',
  components: {
    NavBar
   // HelloWorld
   // Home
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
