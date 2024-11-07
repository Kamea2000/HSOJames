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
      <h2 class="text-xl font-semibold">Update Patient</h2>
      <form @submit.prevent="submit">
        <!-- Form grid for two-column layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
          <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
            <input
              v-model="patient.first_name"
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
              v-model="patient.last_name"
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
              v-model="patient.gender"
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
              v-model="patient.email"
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
              v-model="patient.phone"
              id="phone"
              type="tel"
              class="border w-full p-2 mt-1 rounded"
              required
              placeholder="Enter your phone number"
            />
          </div>

          <div>
            <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
            <input
              v-model="patient.date_of_birth"
              id="date_of_birth"
              type="date"
              class="border w-full p-2 mt-1 rounded"
              required
            />
          </div>

          <div class="md:col-span-2">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input
              v-model="patient.address"
              id="address"
              class="border w-full p-2 mt-1 rounded"
              required
              placeholder="Enter your address"
            />
          </div>

          <div class="md:col-span-2">
            <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Occupation</label>
            <input
              v-model="patient.occupation"
              id="occupation"
              class="border w-full p-2 mt-1 rounded"
              required
              placeholder="Enter your occupation"
            />
          </div>
        </div>

        <div class="flex items-center space-x-4 mt-4">
          <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Update Patient
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
import { ref, defineProps, defineEmits, watch } from 'vue';

const props = defineProps({
  isOpen: Boolean,
  patientData: Object,  // Expecting a prop for the patient data
});

const emit = defineEmits(['update', 'close']);

const patient = ref({
  first_name: '',
  last_name: '',
  gender: '',
  email: '',
  phone: '',
  date_of_birth: '',
  address: '',
  occupation: '',
});

// Watch for changes to the patientData prop (use it to fill the form)
watch(() => props.patientData, (newData) => {
  if (newData) {
    patient.value = { ...newData };
  }
}, { immediate: true });

const submit = () => {
  emit('update', { ...patient.value });  // Emit the update event with the patient data
  close();
};

const close = () => {
  emit('close');  // Close the modal
};
</script>
