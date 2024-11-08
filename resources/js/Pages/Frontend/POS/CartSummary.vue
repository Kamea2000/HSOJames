<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">Shopping Cart</h2>

    <p v-if="!cartItems.length" class="text-gray-500 text-center">
      Your cart is empty.
    </p>

    <ul v-else class="space-y-4">
      <li
        v-for="item in cartItems"
        :key="item.id"
        class="flex justify-between items-center border-b border-gray-200 py-3"
      >
        <!-- Left-aligned section with item name -->
        <span class="flex-grow text-sm font-medium text-gray-800">{{ item.name }}</span>

        <!-- Right-aligned section with price, quantity controller, and remove button -->
        <div class="flex items-center space-x-4">
          <!-- Price -->
          <span class="font-semibold text-gray-900">₱{{ (item.price * item.quantity).toFixed(2) }}</span>

          <!-- Quantity Controller -->
          <div class="flex items-center space-x-2">
            <button
              @click="updateQuantity(item.id, item.quantity - 1)"
              class="text-gray-500 hover:text-gray-700 p-1"
              :disabled="item.quantity <= 1"
              aria-label="Decrease quantity"
            >
              <i class="fas fa-minus-circle"></i>
            </button>
            <span class="text-gray-800 font-medium">{{ item.quantity }}</span>
            <button
              @click="updateQuantity(item.id, item.quantity + 1)"
              class="text-gray-500 hover:text-gray-700 p-1"
              aria-label="Increase quantity"
            >
              <i class="fas fa-plus-circle"></i>
            </button>
          </div>

          <!-- Remove Button -->
          <button
            @click="emitRemove(item.id)"
            class="text-red-500 hover:text-red-700"
            aria-label="Remove item"
          >
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </li>
    </ul>

    <div class="mt-4">
      <div class="flex justify-between items-center">
        <span class="text-lg font-semibold text-gray-900">Total:</span>
        <span class="text-xl font-bold text-gray-800">₱{{ cartTotal.toFixed(2) }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed } from 'vue';

const props = defineProps({
  cartItems: Array,
});

const emit = defineEmits();

// Computes the total price based on cart items
const cartTotal = computed(() => {
  return props.cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
});

// Emits a request to remove an item from the cart
const emitRemove = (itemId) => {
  emit('remove', itemId);
};

// Emits an update request to change item quantity
const updateQuantity = (itemId, newQuantity) => {
  console.log('Updating quantity for item', itemId, 'to', newQuantity);
  if (newQuantity > 0) {
    emit('update-quantity', { itemId, quantity: newQuantity });
  }
};
</script>
