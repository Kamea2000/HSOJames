<template>
  <DashboardLayout>
    <div>
      <h1 class="text-2xl font-bold mb-4">Point of Sale</h1>
      <div class="flex">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="flex items-center p-4 border-b border-neutral-200">
            <label for="search" class="mr-2 font-medium">Search:</label>
            <input
              type="text"
              id="search"
              v-model="searchQuery"
              placeholder="Search Products..."
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 pl-10 p-2"
            />
            <!-- Category filter dropdown -->
            <label for="category-filter" class="ml-4 mr-2 font-medium">Category:</label>
            <select
              id="category-filter"
              v-model="selectedCategory"
              @change="filterByCategory"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-64 p-2"
              style="width: 16rem;"
            >
              <option value="">All Categories</option>
              <option v-for="category in props.categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          
          <div class="overflow-x-auto">
            <div v-if="products.length === 0" class="text-gray-500 text-center py-8">
              No products yet
            </div>
            <table class="min-w-full text-left text-sm font-light text-gray-700">
              <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                  <th scope="col" class="px-6 py-4">Id</th>
                  <th scope="col" class="px-6 py-4">Name</th>
                  <th scope="col" class="px-6 py-4">Category</th>
                  <th scope="col" class="px-6 py-4">Price</th>
                  <th scope="col" class="px-6 py-4">Description</th>
                  <th scope="col" class="px-6 py-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in paginatedProducts" :key="item.id" class="border-b border-neutral-200 transition hover:bg-neutral-100">
                  <td class="whitespace-nowrap px-6 py-4">{{ item.id }}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{ item.name }}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{ categoryMap[item.category_id] || 'Uncategorized' }}</td>
                  <td class="whitespace-nowrap px-6 py-4"><a>₱ </a>{{ item.price }}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{ item.description }}</td>
                  <td class="whitespace-nowrap px-6 py-4">
                    <button @click="addToCart(item)">Add</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- pagination -->
          <div class="flex flex-col md:flex-row justify-between items-center p-4 border-t border-neutral-200 relative z-10">
            <span class="text-sm font-normal text-gray-500">
              Showing <span class="font-semibold">{{ startItem }}</span> - <span class="font-semibold">{{ endItem }}</span> of <span class="font-semibold">{{ totalItems }}</span>
            </span>
            <ul class="inline-flex items-stretch -space-x-px mt-2 md:mt-0">
              <li>
                <button @click="prevPage" :disabled="currentPage === 1" class="px-3 py-1.5 border rounded-l-lg">Prev</button>
              </li>
              <li v-for="page in totalPages" :key="page">
                <button @click="changePage(page)" :class="['px-3 py-1.5 border', currentPage === page ? 'bg-gray-300' : 'bg-white']">{{ page }}</button>
              </li>
              <li>
                <button @click="nextPage" :disabled="currentPage === totalPages" class="px-3 py-1.5 border rounded-r-lg">Next</button>
              </li>
            </ul>
          </div>
        </div>
    
        <!-- Cart Summary Section -->
        <div class="w-1/3 p-4">
          <CartSummary :cartItems="cartItems" :cartTotal="cartTotal" @remove="removeFromCart" @update-quantity="handleUpdateQuantity"/>
          <PaymentOptions :cartTotal="cartTotal" @processPayment="processPayment" />
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
<script setup>
import CartSummary from './CartSummary.vue';
import PaymentOptions from './PaymentOptions.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Inertia } from '@inertiajs/inertia'; // Make sure this line is present
import { ref, watch, computed, defineProps} from 'vue';;
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    products: Array,
    categories: Array,
    flash: Object,
});


const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(5);
const selectedCategory = ref(''); // Empty string for "All Categories"


// Computed property for filtering products by search
const filteredProducts = computed(() => {
    return props.products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(searchQuery.value.toLowerCase());
        const matchesCategory = selectedCategory.value === '' || product.category_id === selectedCategory.value;
        return matchesSearch && matchesCategory && product.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    });
});

// Computed properties for pagination
const totalItems = computed(() => filteredProducts.value.length);
const startItem = computed(() => (currentPage.value - 1) * itemsPerPage.value + 1);
const endItem = computed(() => Math.min(startItem.value + paginatedProducts.value.length - 1, totalItems.value));

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredProducts.value.slice(start, end);
});

const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage.value));

// Pagination navigation
const nextPage = () => {
    if (currentPage.value < totalPages.value) currentPage.value++;
};

const prevPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};

const changePage = (page) => {
    currentPage.value = page;
};

// Create a mapping of category IDs to category names
const categoryMap = computed(() => {
    const map = {};
    props.categories.forEach(category => {
        map[category.id] = category.name; // Map category ID to category name
    });
    return map;
});
//for dropdown modal add, edit, delete
const dropdownOpen = ref(null); // Store the id of the opened dropdown

const toggleDropdown = (itemId) => {
    dropdownOpen.value = dropdownOpen.value === itemId ? null : itemId; // Toggle dropdown visibility
};

const closeDropdown = () => {
    dropdownOpen.value = null;
};

// Attach event listener to handle clicks outside of dropdown
onMounted(() => {
    window.addEventListener('click', (event) => {
        const target = event.target;
        const isDropdownButton = target.closest('#apple-ipad-air-dropdown-button'); // Check if clicked inside the button
        const isDropdownMenu = target.closest('.absolute'); // Check if clicked inside the dropdown
        if (!isDropdownButton && !isDropdownMenu) {
            closeDropdown(); // Close if clicked outside
        }
    });
});

onBeforeUnmount(() => {
    window.removeEventListener('click', closeDropdown);
});



const cartItems = ref([]);

// Function to add an item to the cart
const addToCart = (product) => {
  // Check if the product is already in the cart
  const existingItem = cartItems.value.find(item => item.id === product.id);
  
  if (existingItem) {
    existingItem.quantity += 1; // Increase the quantity if already in the cart
  } else {
    cartItems.value.push({ ...product, quantity: 1 }); // Add new product with quantity 1
  }
};


//Cart Total Calculation
const cartTotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + item.price * item.quantity, 0);
});

// Function to remove an item from the cart
const removeFromCart = (itemId) => {
  cartItems.value = cartItems.value.filter(item => item.id !== itemId);
};

// Process payment function
const processPayment = (paymentDetails) => {
  // Your logic for handling payment here
  console.log('Processing payment...', paymentDetails);

  // After payment is processed, you can reset the cart or navigate to another page
  cartItems.value = [];  // Clear cart after successful payment
};

const handleUpdateQuantity = ({ itemId, quantity }) => {
  const item = cartItems.value.find(item => item.id === itemId);
  if (item) item.quantity = quantity;
};
</script>
