<template>
  <div>
    <ul>
      <BlogListItem v-for="post in posts" :key="post.id" :post="post" />
    </ul>
  </div>
</template>

<script>
import data from "../post-data.json";
import BlogListItem from "../components/BlogListItem"

export default {
  components: {
    BlogListItem
  },
  data(){
    return {
      posts: []
    }
  },
  mounted() {
    this.posts = data.posts;
  }
};
</script>

<style>
</style>