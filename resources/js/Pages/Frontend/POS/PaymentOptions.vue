<template>
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h3 class="font-semibold text-2xl text-gray-800 mb-4">Payment Options</h3>

    <div class="mt-4">
      <label class="block text-gray-700 font-medium mb-2">Payment Method</label>
      <select v-model="paymentMethod" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        <option value="cash">Cash</option>
        <option value="credit">Credit</option>
        <option value="discount">Discount</option>
      </select>
    </div>

    <div class="mt-4">
      <label v-if="paymentMethod === 'discount'" class="block text-gray-700 font-medium mb-2">Discount Amount</label>
      <input
        v-if="paymentMethod === 'discount'"
        type="number"
        v-model="discountAmount"
        placeholder="Enter discount amount"
        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
      />
    </div>

    <button
      @click="processPayment"
      class="mt-6 w-full py-3 bg-green-600 text-white rounded-lg font-semibold shadow-md hover:bg-green-700 transition duration-300"
    >
      Process Payment
    </button>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits();
const paymentMethod = ref('cash');
const discountAmount = ref(0);

// Emits payment details to parent component
const processPayment = () => {
  const paymentDetails = {
    method: paymentMethod.value,
    discount: paymentMethod.value === 'discount' ? discountAmount.value : 0,
  };
  emit('processPayment', paymentDetails);
};
</script>

<style scoped>
/* Optional: Additional custom styles for the component */
</style>
