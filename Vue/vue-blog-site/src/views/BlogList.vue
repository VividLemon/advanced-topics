<template>
  <div>
    <ul>
      <BlogListItem v-for="post in posts" :key="post.id" :post="post" />
    </ul>
  </div>
</template>

<script>
import axios from "axios"
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
    //this.posts = data.posts;
    axios.get("http://localhost:3000/posts").then((response) => {
      console.log(response.data);
      this.posts = response.data;
    }).catch((err) => {
      console.log(`Error: ${err}`);
    });
  }
};
</script>

<style>
</style>