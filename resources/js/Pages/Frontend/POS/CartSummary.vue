<template>
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-xl font-semibold mb-4">Shopping Cart</h2>
  
      <p v-if="!cartItems.length" class="text-gray-500 text-center">
        Your cart is empty.
      </p>
  
      <ul v-else class="space-y-4">
        <li v-for="item in cartItems" :key="item.id" class="flex items-center justify-between border-b border-gray-200 py-3">
          <div class="flex items-center space-x-4">
            <span class="font-medium text-gray-800">{{ item.name }}</span>
            <span class="text-sm text-gray-500">x {{ item.quantity }}</span>
          </div>
          <div class="flex items-center space-x-2">
            <span class="font-semibold text-gray-900">₱{{ item.price * item.quantity }}</span>
            <button
              @click="emitRemove(item.id)"
              class="text-red-500 hover:text-red-700"
              aria-label="Remove item"
            >
              <i class="fas fa-trash"></i> Remove
            </button>
          </div>
        </li>
      </ul>
  
      <div class="mt-4">
        <div class="flex justify-between items-center">
          <span class="text-lg font-semibold text-gray-900">Total:</span>
          <span class="text-xl font-bold text-gray-800">₱{{ cartTotal }}</span>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    cartItems: Array,
    cartTotal: Number,
  });
  
  const emit = defineEmits();
  
  const emitRemove = (itemId) => {
    emit('remove', itemId);
  };
  </script>
  
  