
<template>
    <div>
      <h2>Edit Product</h2>
      <form @submit.prevent="updateProduct">
        <label for="name">Name:</label>
        <input type="text" v-model="data.name" required />
  
        <label for="price">Price:</label>
        <input type="number" v-model="data.price" required />
  
        <button type="submit">Save</button>
      </form>
  <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md">
      <h2>Edit Product</h2>
      <form @submit.prevent="submit">
        <div>
          <label for="name">Name</label>
          <input v-model="product.name" id="name" class="border w-full p-2 mt-1" required />
        </div>
        <div>
          <label for="price">Price</label>
          <input v-model="product.price" id="price" class="border w-full p-2 mt-1" required />
        </div>
        <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Save</button>
        <button @click.prevent="close" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Cancel</button>
      </form>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps(['isOpen', 'product']);
const emit = defineEmits();

const submit = () => {
  emit('save', { ...product }); // Emit the updated product
  close();
};

const close = () => {
  emit('close');
};
</script>

    
  
  <script>
  export default {
    props: {
      data: Object,
    },
    methods: {
      updateProduct() {
        // Implement your update logic here
        console.log('Product updated:', this.data);
      },
    },
  };
  </script>
  