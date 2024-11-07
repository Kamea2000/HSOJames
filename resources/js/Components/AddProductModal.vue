<template>
    <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow-md">
        <h2>Add New Product</h2>
        <form @submit.prevent="submit">
          <div>
            <label for="name">Name</label>
            <input v-model="product.name" id="name" class="border w-full p-2 mt-1" required />
          </div>
          <div>
            <label for="price">Price</label>
            <input v-model="product.price" id="price" type="number" class="border w-full p-2 mt-1" required />
          </div>
          <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
          <button @click.prevent="close" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Cancel</button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  
  const props = defineProps(['isOpen']);
  const emit = defineEmits();
  
  const product = ref({
    name: '',
    price: ''
  });
  
  const submit = () => {
    emit('add', { ...product.value });
    product.value = { name: '', price: '' }; // Reset the product fields
    close();
  };
  
  const close = () => {
    emit('close');
  };
  </script>
  