<template>
    <div v-if="isOpen" class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50">
      <!-- Background overlay -->
      <div class="bg-gray-900 opacity-50" @click="close"></div>
  
      <!-- Modal container -->
      <div class="relative max-w-md w-full bg-white shadow dark:bg-gray-800">
        <!-- Modal header -->
        <div class="flex justify-between items-center px-4 py-2 bg-gray-200 border-b dark:bg-gray-700">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ actionTitle }}</h3>
          <button @click="close" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
            <span class="text-2xl">&times;</span>
          </button>
        </div>
  
        <!-- Modal body -->
        <div class="p-4 text-left">
          <div v-if="action === 'show'">
            <p class="text-gray-700 dark:text-gray-300 mb-4">Preview patient details:</p>
            <p><strong>Name:</strong> {{ patient.name }}</p>
            <p><strong>Email:</strong> {{ patient.email }}</p>
            <p><strong>Occupation:</strong> {{ patient.occupation }}</p>
            <p><strong>Address:</strong> {{ patient.address }}</p>
          </div>
  
          <div v-if="action === 'edit'">
            <p class="text-gray-700 dark:text-gray-300 mb-4">Edit patient details:</p>
            <input v-model="editablePatient.name" placeholder="Name" class="border rounded p-1 mb-2 w-full" />
            <input v-model="editablePatient.email" placeholder="Email" class="border rounded p-1 mb-2 w-full" />
            <input v-model="editablePatient.occupation" placeholder="Occupation" class="border rounded p-1 mb-2 w-full" />
            <input v-model="editablePatient.address" placeholder="Address" class="border rounded p-1 mb-2 w-full" />
          </div>
  
          <div v-if="action === 'delete'">
            <p class="text-gray-700 dark:text-gray-300 mb-4">
              Are you sure you want to delete this patient: <strong>{{ patient.name }}</strong>?
            </p>
          </div>
  
          <div class="flex justify-end space-x-4">
            <button @click="close" class="px-4 py-2 text-sm text-gray-600 bg-gray-200 focus:outline-none hover:underline">
              Cancel
            </button>
            <button 
              v-if="action === 'delete'" 
              @click="confirmDelete" 
              class="text-red-600 inline-flex items-center border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white"
            >
              Delete
            </button>
            <button 
              v-if="action === 'edit'" 
              @click="saveEdit" 
              class="text-blue-600 inline-flex items-center border border-blue-600 hover:bg-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-600 dark:hover:text-white"
            >
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    isOpen: Boolean,
    action: String, // 'show', 'edit', or 'delete'
    patient: Object // patient object for showing or editing
  });
  const emit = defineEmits(['close', 'delete', 'save']);
  
  const editablePatient = ref({ ...props.patient }); // For editing patient details
  
  const actionTitle = computed(() => {
    if (props.action === 'edit') return 'Edit Patient';
    if (props.action === 'show') return 'Preview Patient';
    if (props.action === 'delete') return 'Confirm Delete';
    return '';
  });
  
  const close = () => {
    emit('close');
  };
  
  const confirmDelete = () => {
    emit('delete', props.patient); // Pass the patient object to the parent for deletion
    close();
  };
  
  const saveEdit = () => {
    emit('save', editablePatient.value); // Pass the edited patient data to the parent
    close();
  };
  </script>
  