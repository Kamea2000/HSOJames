<template>
    <div>
      <h2 class="text-lg font-semibold">Cart</h2>
      <div v-for="item in cartItems" :key="item.id" class="flex justify-between items-center">
        <span>{{ item.name }} - {{ item.quantity }}</span>
        <button @click="$emit('remove', item.id)" class="text-red-500">Remove</button>
      </div>
      <div class="mt-4 font-semibold">Total: ${{ cartTotal }}</div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      cartItems: Array,
      cartTotal: Number
    }
  };
  </script>
  