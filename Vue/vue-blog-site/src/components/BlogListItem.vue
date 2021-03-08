
<template>
  <li>
    <b>{{ post.title }}</b>
    <br />
    <router-link :to="{ name: 'blog', params: { id: post.id } }">READ</router-link>
  </li>
</template>

<script>
export default {
  props: {
    post: Object,
  },
};
</script>

<!--<style lang="scss" scoped> need to install sass-loader for this version of the style tag to work-->
<style scoped>
li {
  list-style: none;
}
</style> 