<template>
  <div>
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
        <span class="flex-grow text-sm font-medium text-gray-800">{{ item.name }}</span>
        <div class="flex items-center space-x-4">
          <span class="font-semibold text-gray-900">₱{{ (item.price * item.quantity).toFixed(2) }}</span>

          <div class="flex items-center space-x-2">
            <button
              @click="updateQuantity(item.id, item.quantity - 1)"
              :disabled="item.quantity && item.quantity <= 1"
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

    <!-- Customer Name Input -->
    <div class="mt-4">
      <label for="name" class="block text-gray-700 font-medium mb-2">Customer Name</label>
      <input
        v-model="name"
        id="name"
        type="text"
        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
        required
        placeholder="Enter customer name"
      />
    </div>

    <!-- Discount Amount Input -->
    <div class="mt-4">
      <label class="block text-gray-700 font-medium mb-2">Discount Amount</label>
      <input
        type="number"
        v-model="discountAmount"
        placeholder="Enter discount amount"
        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
      />
    </div>

    <button
      @click="processPayment"
      class="mt-6 w-full py-3 bg-green-500 text-white rounded-lg font-semibold shadow-md hover:bg-green-700 transition duration-300"
    >
      Process Payment
    </button>

    <!-- Success Message (rendered from Inertia response) -->
    <p v-if="message" class="mt-4 text-green-500">{{ message }}</p>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';


const props = defineProps({
  cartItems: { type: Array, required: true },
  message: { type: String, default: '' },
});

const emit = defineEmits();

const name = ref('');
const discountAmount = ref(0);

const cartTotal = computed(() => {
  const subtotal = props.cartItems.reduce((total, item) => total + (item.price * item.quantity || 0), 0);
  return Math.max(subtotal - discountAmount.value, 0);
});

const emitRemove = (itemId) => {
  emit('remove', itemId);
};

const updateQuantity = (itemId, newQuantity) => {
  if (newQuantity > 0) {
    emit('update-quantity', { itemId, quantity: newQuantity });
  }
};

const processPayment = () => {
  // Perform the Inertia post request to handle the transaction
  Inertia.post(route('transactions.store'), {
    customer_name: name.value,
    total: cartTotal.value,
    discount_amount: discountAmount.value,
    cart_items: props.cartItems,
  });
};
</script>
