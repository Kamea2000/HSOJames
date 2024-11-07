<template>
    <div>
      <h2 class="text-lg font-semibold">Payment</h2>
      <select v-model="paymentMethod" class="p-2 border border-gray-300 rounded">
        <option value="cash">Cash</option>
        <option value="credit">Credit</option>
      </select>
      <button @click="handlePayment" class="btn-primary mt-2">Complete Payment</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        paymentMethod: 'cash'
      };
    },
    methods: {
      handlePayment() {
        this.$emit('processPayment', { method: this.paymentMethod });
      }
    }
  };
  </script>
  