<template>
  <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
      <button @click="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 transition duration-200 text-2xl p-2">
        &times;
      </button>
      <h2 class="text-xl font-semibold mb-4">Patient Details</h2>
      <div class="mb-2" v-if="patients">
        <p><strong>ID:</strong> <span class="text-gray-700">{{ patients.id }}</span></p>
      </div>
      <div class="mb-2" v-if="patients">
        <p><strong>Name:</strong> <span class="text-gray-700">{{ patients.name }}</span></p>
      </div>
      <div class="mb-2" v-if="patients">
        <p><strong>Email:</strong> <span class="text-gray-700">{{ patients.email }}</span></p>
      </div>
      <div class="mb-2" v-if="patients">
        <p><strong>Occupation:</strong> <span class="text-gray-700">{{ patients.occupation }}</span></p>
      </div>
      <div class="mb-2" v-if="patients">
        <p><strong>Address:</strong> <span class="text-gray-700">{{ patients.address }}</span></p>
      </div>
      <div class="mb-2" v-if="patients">
        <p><strong>Date of Birth:</strong> <span class="text-gray-700">{{ patients.date_of_birth }}</span></p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps(['isOpen', 'patients']);
const emit = defineEmits();

const close = () => {
  emit('close');
};


</script>
