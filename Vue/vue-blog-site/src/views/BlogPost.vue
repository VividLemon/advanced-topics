
<template>
  <div>
      <h2>{{title}}</h2>
      <h3>{{author}}</h3>
      <div v-html="content" class="blog-content"></div>
      <!--NOTE: You must use the v-html directive to display HTML content-->
      <VoteBox :postId="id" message="Did you like this post?" />
    </div>
</template>

<script>
import axios from "axios";
 import VoteBox from "../components/VoteBox.vue";

    export default {
        components: {
            VoteBox,
        },
        props: ["id"],
        data() {
        return {
            title: "",
            content: "",
            author: "",
        };
        },
        methods: {
        // getPostById(postId) {
        //     var allPosts = data.posts;
        //     for (var x = 0; x < allPosts.length; x++) {
        //         if (allPosts[x].id == postId) {
        //         return allPosts[x];
        //         }
        //     }
        // },
        
    },
    mounted() {
        // var post = this.getPostById(this.id);
        // this.title = post.title;
        // this.author = post.author;
        // this.content = post.post;
        axios.get("http://localhost:3000/posts/" + this.id).then((response) => {
            //console.log(this);
            this.title = response.data.title;
            this.content = response.data.post;
            this.author = response.data.author;
        }).catch((error) => {
            //console.log("ERROR!!! " + error.response);
            console.log(error);
        });
    }
  };
</script>
