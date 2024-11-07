<template>
    <div v-if="isOpen" class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50">
      <!-- Background overlay -->
      <div class="bg-gray-900 opacity-50" @click="close"></div>
  
      <!-- Modal container -->
      <div class="relative max-w-md max-h-full w-full bg-white shadow dark:bg-gray-800">
        <!-- Modal header -->
        <div class="flex justify-between items-center px-4 py-2 bg-red-200 border-b dark:bg-gray-700">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ title }}</h3>
          <button @click="close" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
            <span class="text-2xl">&times;</span>
          </button>
        </div>
  
        <!-- Modal body -->
        <div class="p-4 text-left">
          <!-- Main content or slot area -->
          <p class="text-gray-700 dark:text-gray-300 mb-4">
            Are you sure you want to delete this patient: <strong>{{ patientName }}</strong>?
          </p>
  
          <div class="flex justify-end space-x-4">
            <button @click="close" class="px-4 py-2 text-sm text-gray-600 bg-gray-200 focus:outline-none hover:underline">
              Cancel
            </button>
            <button @click="confirmDelete" class="text-red-600 inline-flex items-center border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    isOpen: Boolean,
    title: { type: String, default: 'Confirm Delete' },
    patientName: String // This will hold the name of the patient to be deleted
  });
  const emit = defineEmits(['close', 'confirm']);
  
  const confirmDelete = () => {
    emit('confirm'); // Emit the confirm event to handle deletion
  };
  
  const close = () => {
    emit('close'); // Emit the close event to close the modal
  };
  </script>
  