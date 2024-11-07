<template>
    <div class="mb-4">
      <select
        v-model="selectedCategory"
        @change="onFilter"
        class="w-full p-2 border rounded"
      >
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    categories: Array, // categories passed as prop from the parent component
  });
  
  const emit = defineEmits(); // Used to emit events
  
  
  </script>
  
  <style scoped>
  /* You can add custom styles here */
  </style>
  