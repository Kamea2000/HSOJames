<template>
    <DashboardLayout>
    <div class="flex flex-col lg:flex-row p-4 ">
      <!-- Product Selection Section -->
      <div class="w-full lg:w-2/3 p-4 bg-white shadow-lg rounded">
        <SearchBar @search="searchProducts" />
        <CategoryFilter :categories="categories" @filter="filterByCategory" />
        <ProductGrid :products="filteredProducts" @add="addToCart" />
        <ProductList />
      </div>
      <!-- Cart Summary Section -->
      <div class="w-full lg:w-1/3 p-4 bg-white shadow-lg rounded ml-4">
        <CartSummary :cartItems="cartItems" @remove="removeFromCart" />
        <PaymentOptions :cartTotal="cartTotal" @processPayment="processPayment" />
      </div>
    </div>
</DashboardLayout>
  </template>
  
  <script setup>
import { ref, onMounted } from 'vue';
import SearchBar from './SearchBar.vue';
//import CategoryFilter from './CategoryFilter.vue';
//import ProductGrid from './ProductGrid.vue';
import ProductList from './ProductList.vue';
import CartSummary from './CartSummary.vue';
import PaymentOptions from './PaymentOption.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';


// State variables
const products = ref([]);
const filteredProducts = ref([]);
const cartItems = ref([]);
const cartTotal = ref(0);
const categories = ref([]);

// Methods
const searchProducts = (query) => {
  // Fetch products based on search query
};

const filterByCategory = (category) => {
  // Filter products by selected category
};

const addToCart = (product) => {
  // Add product to cart
};

const removeFromCart = (productId) => {
  // Remove product from cart
};

const processPayment = (paymentDetails) => {
  // Process payment
};

// Fetch data on component mount
const fetchProducts = async () => {
  // Fetch products from API
};

const fetchCategories = async () => {
  // Fetch categories from API
};

onMounted(() => {
  fetchProducts();
  fetchCategories();
});
</script>