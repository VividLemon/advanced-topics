<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link :to="{name: 'Users'}">Users</router-link>
    </div>
    <router-view/>
  </div>
</template>

<style lang="scss">
            @import './assets/main.scss';
</style>


