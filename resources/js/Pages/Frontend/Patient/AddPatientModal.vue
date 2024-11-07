<template>
    <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="z-index: 1000;">
      <div class="bg-white p-6 rounded shadow-md w-full max-w-md relative">
        <button
          @click="close"
          class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 transition duration-200 text-2xl p-2"
          aria-label="Close"
        >
          &times;
        </button>
        <h2 class="text-xl font-semibold">Add Patient</h2>
        <form @submit.prevent="submit">
          <!-- Form grid for two-column layout -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
              <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
              <input
                v-model="first_name"
                id="first_name"
                type="text"
                class="border w-full p-2 mt-1 rounded"
                required
                placeholder="Enter first name"
              />
            </div>
            <div>
              <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
              <input
                v-model="last_name"
                id="last_name"
                type="text"
                class="border w-full p-2 mt-1 rounded"
                required
                placeholder="Enter last name"
              />
            </div>

            

            <div>
  <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
  <select
    v-model="gender"
    id="gender"
    class="border w-full p-2 mt-1 rounded"
    required
  >
    <option value="" disabled>Select gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select>
</div>

  
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input
                v-model="email"
                id="email"
                type="email"
                class="border w-full p-2 mt-1 rounded"
                required
                placeholder="Enter your email"
              />
            </div>
  
            <div>
              <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
              <input
                v-model="phone"
                id="phone"
                type="tel"
                class="border w-full p-2 mt-1 rounded"
                required
                placeholder="Enter your phone number"
                autocomplete="tel"
                autocorrect="off"
                autocapitalize="none"
              />
            </div>
  
            <div>
              <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
              <input
                v-model="date_of_birth"
                id="date_of_birth"
                type="date"
                class="border w-full p-2 mt-1 rounded"
                required
              />
            </div>
            <div class="md:col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input
                v-model="address"
                id="address"
                class="border w-full p-2 mt-1 rounded resize-none overflow-hidden h-10"
                required
                placeholder="Enter your address"
                />
            </div>
  
            <div class="md:col-span-2">
              <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Occupation</label>
              <input
                v-model="occupation"
                id="occupation"
                class="border w-full p-2 mt-1 rounded"
                required
                placeholder="Enter your occupation"
              />
            </div>
          </div>
  
          <div class="flex items-center space-x-4 mt-4">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <!-- Plus Icon -->
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <!-- Button Text -->
            <span>Add Patient</span>
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
  
  const first_name = ref('');
  const last_name = ref('');
  const gender = ref('');
  const email = ref('');
  const phone = ref('');
  const date_of_birth = ref('');
  const address = ref('');
  const occupation = ref('');
  
  const submit = () => {
    const data = {
      first_name: first_name.value.trim(),
      last_name: last_name.value.trim(),
      gender: gender.value.trim(),
      email: email.value.trim(),
      phone: phone.value.trim(),
      date_of_birth: date_of_birth.value,
      address: address.value.trim(),
      occupation: occupation.value.trim(),
    };
  
    emit('add', data);
  
    first_name.value = '';
    last_name.value = '';
    gender.value = '';
    email.value = '';
    phone.value = '';
    date_of_birth.value = '';
    address.value = '';
    occupation.value = '';
  
    close();
  };
  
  const close = () => {
    emit('close');
  };
  </script>
  