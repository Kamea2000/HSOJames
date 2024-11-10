<template>
  <div class="">
    <h3 class="font-semibold text-2xl text-gray-800 mb-4">Payment Options</h3>
    
    <div class="mt-4">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Customer Name</label>
        <input
          v-model="name"
          id="name"
          type="text"
          class="border w-full p-2 mt-1 rounded"
          required
          placeholder="Enter first name"
        />
      </div>
    </div>

    <div class="mt-4">
      <label class="block text-gray-700 text-sm font-medium mb-2">Payment Method</label>
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

    <!-- Discounted Option Radio Button -->
    <!-- <div class="mt-4 flex items-center">
      <input 
        type="radio"
        id="discounted"
        v-model="isDiscounted"
        value="true"
        class="mr-2 custom-radio"
      />
      <label for="discounted" class="text-gray-700 text-sm font-medium">Discounted</label>
    </div> -->

    <button
      @click="processPayment"
      class="mt-6 w-full py-3 bg-green-500 text-white rounded-lg font-semibold shadow-md hover:bg-green-700 transition duration-300"
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

import { Inertia } from '@inertiajs/inertia';

const processPayment = () => {
  const transactionData = {
    customer_name: name,
    payment_method: paymentMethod,
    discount_amount: paymentMethod === 'discount' ? discountAmount : null,
    total_amount: cartTotal.value,
    cart_items: cartItems,
  };

  Inertia.post('/transactions', transactionData, {
    onSuccess: (page) => {
      console.log(page.props.flash.message || 'Transaction recorded successfully');
      // You can use page.props.flash.message if you set a flash message in the controller
      // Handle success, such as showing a success message or redirecting
    },
    onError: (errors) => {
      console.error(errors);
      // Handle errors (e.g., display validation errors)
    }
  });
};
</script>

<style scoped>
/* Custom styling for the radio button */
.custom-radio {
  width: 20px;
  height: 20px;
  border: 2px solid #4CAF50; /* Green border */
  border-radius: 4px; /* Rounded corners, making it square with rounded edges */
  appearance: none; /* Remove default radio button styling */
  outline: none;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.custom-radio:checked {
  background-color: #4CAF50; /* Green when checked */
  border-color: #4CAF50;
}

.custom-radio:checked::after {
  content: '';
  position: absolute;
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background-color: white; /* Inner circle when checked */
  border-radius: 50%;
}

.custom-radio:focus {
  border-color: #66BB6A; /* Focus effect */
}
</style>
