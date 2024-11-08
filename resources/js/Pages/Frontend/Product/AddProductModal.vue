<template>
  <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md max-w-md w-full relative">
      <button @click.prevent="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 transition duration-200 text-2xl p-2">&times;</button>
      <h2 class="text-lg font-semibold mb-4">Add New Product</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
          <input v-model="product.name" id="name" class="border w-full p-2 mt-1 rounded" required />
        </div>
        <div class="mb-4">
          <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
          <input v-model="product.price" id="price" step="0.01" type="number" class="border w-full p-2 mt-1 rounded" required />
        </div>
        <div class="mb-4">
          <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select Category</label>
          <select v-model="product.category_id" id="category" class="border w-full p-2 mt-1 rounded" required>
            <option value="" disabled>Select a category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>
        <div class="mb-4">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
          <textarea v-model="product.description" id="description" rows="4" class="border w-full p-2 mt-1 rounded" placeholder="Write product description here"></textarea>
        </div>
        <div class="mb-4">
          <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
          <input v-model="product.quantity" id="quantity" type="number" class="border w-full p-2 mt-1 rounded" required />
        </div>
        <div class="flex justify-between">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
          <button @click.prevent="close" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
  isOpen: {
    type: Boolean,
    required: true,
  },
});

const emit = defineEmits();
const product = ref({
  name: '',
  price: '',
  category_id: null, // Store category ID here
  description: '',
  quantity: ''
});

const submit = () => {
  console.log('Product data before submit:', product.value);
  if (!product.value.category_id) {
    alert("Please select a category.");
    return;
  }

  // Emit the product data including the category ID
  emit('add', { 
    name: product.value.name,          // Product Name
    price: product.value.price,        // Product Price
    category_id: product.value.category_id, // Selected Category ID
    description: product.value.description, // Product Description
    quantity: product.quantity
  });

  emit('add', { 
    name: product.value.name,
    price: product.value.price,
    category_id: product.value.category_id,
    description: product.value.description,
    quantity: product.value.quantity
  });

  resetForm();
  emit('close');
};


const resetForm = () => {
  product.value = { name: '', price: '', category_id: null, description: '' }; // Reset all fields
};

const close = () => {
  emit('close'); // Emit the close event to parent to change `isOpen` to false
};
</script>
