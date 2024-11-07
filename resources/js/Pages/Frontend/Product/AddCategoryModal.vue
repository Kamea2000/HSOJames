<template>
  <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md">
      <h2 class="text-xl font-semibold">Add Category</h2>
      <form @submit.prevent="submit">
        <div class="mt-4">
          <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
          <input
            v-model="categoryName"
            id="categoryName"
            class="border w-full p-2 mt-1 rounded"
            required
            placeholder="Enter category name"
          />
        </div>
        <div class="mt-4 flex justify-between">
          <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
          >
            Add
          </button>
          <button
            type="button" 
            @click="close"
            class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400 transition"
          >
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps(['isOpen']);
const emit = defineEmits();

const categoryName = ref('');

const submit = () => {
  const trimmedName = categoryName.value.trim();
  if (trimmedName === '') {
    alert('Category name cannot be empty.');
    return; // Prevent adding empty categories
  }

  emit('add', trimmedName); // Emit the category name to the parent
  categoryName.value = ''; // Reset the input field after submission
  close(); // Close the modal
};

const close = () => {
  emit('close'); // Emit a close event to the parent component
};
</script>

<style scoped>
/* Add any additional styles here if necessary */
</style>
