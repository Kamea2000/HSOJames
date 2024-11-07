<template>
    <Modal :isOpen="isOpen" @close="closeModal">
      <h2>Show Product</h2>
      <p><strong>Name:</strong> {{ product.name }}</p>
      <p><strong>Price:</strong> {{ product.price }}</p>
    </Modal>
  </template>
  
  <script setup>
  import Modal from './Modal.vue';
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    isOpen: Boolean,
    product: Object,
  });
  const emit = defineEmits(['close']);
  
  const closeModal = () => emit('close');
  </script>
  