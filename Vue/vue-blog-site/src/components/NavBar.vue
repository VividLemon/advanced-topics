<template>
      <div id="nav">
        <router-link to="/">Home</router-link>|
        <router-link :to="{ name: 'blog-list' }">Blog</router-link>
      </div>
</template>

