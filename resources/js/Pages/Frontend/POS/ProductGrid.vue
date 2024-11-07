<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div
        v-for="product in products"
        :key="product.id"
        class="border p-4 rounded-lg shadow"
      >
        <img :src="product.image_url" alt="Product Image" class="w-full h-40 object-cover mb-4" />
        <h3 class="font-semibold text-lg">{{ product.name }}</h3>
        <p class="text-sm">{{ product.description }}</p>
        <p class="font-semibold text-gray-800 mt-2">${{ product.price }}</p>
        <button
          @click="addToCart(product)"
          class="mt-2 w-full py-2 px-4 bg-blue-600 text-white rounded"
        >
          Add to Cart
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps({
    products: Array,
  });
  
  // Emits the selected product to the parent component to be added to the cart
  const addToCart = (product) => {
    emit('add', product);
  };
  </script>
  
  <style scoped>
  /* You can add custom styles here */
  </style>
  