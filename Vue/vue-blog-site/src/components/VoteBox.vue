<template>
  <div class="vote-box">
    <h3>{{ message }}</h3>
    <VoteButton
      @vote-button-click="handleVoteButtonClick"
      label="Like"
      value="yes"
    />
    <VoteButton
      @vote-button-click="handleVoteButtonClick"
      label="Dislike"
      value="no"
    />
  </div>
</template>

<script>
import VoteButton from "./VoteButton"

export default {
  props: ["message", "postId"],
  components: {
    VoteButton,
  },
  methods: {
    handleVoteButtonClick(value) {
      console.log("Voted to " + value + " for post: " + this.postId);
    },
  },
};
</script>

<style>
</style>
