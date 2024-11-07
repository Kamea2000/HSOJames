<template>
    <input
      type="text"
      placeholder="Search products..."
      @input="onSearch"
      class="w-full p-2 border border-gray-300 rounded"
    />
  </template>
  
  <script>
  export default {
    methods: {
      onSearch(event) {
        this.$emit('search', event.target.value);
      }
    }
  };
  </script>
  