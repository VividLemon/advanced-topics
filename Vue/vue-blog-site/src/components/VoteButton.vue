<template>
  <button @click="handleClick">{{ label }}</button>
</template>

<script>
export default {
  props: {
    label: String,
    value: String,
  },
  methods: {
    handleClick() {
      this.$emit("vote-button-click", this.value);
    },
  },
};
</script>

<style>
</style>