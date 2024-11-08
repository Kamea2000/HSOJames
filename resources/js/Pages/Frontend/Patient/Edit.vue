<!-- EditModal.vue -->
<template>
    <div v-if="isOpen">
        <div class="modal-content">
            <form @submit.prevent="saveChanges">
                <div>
                    <label for="first-name">First Name</label>
                    <input
                        type="text"
                        id="first-name"
                        v-model="patientData.first_name"
                    />
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input
                        type="text"
                        id="last-name"
                        v-model="patientData.last_name"
                    />
                </div>
                <div>
                    <label for="occupation">Occupation</label>
                    <input
                        type="text"
                        id="occupation"
                        v-model="patientData.occupation"
                    />
                </div>
                <!-- Add more fields as necessary -->
                <button type="submit">Save Changes</button>
                <button @click="$emit('close')">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script setup>
defineProps({
  isOpen: Boolean,
  patientData: Object,  
});

const emit = defineEmits(['close', 'save']);

const saveChanges = () => {
    // Trigger the update event when the form is submitted
    emit('save');
};
</script>
