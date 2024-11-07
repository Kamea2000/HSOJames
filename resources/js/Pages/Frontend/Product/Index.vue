<template>
    <DashboardLayout>
    <Head title="Products" />

    <!-- Alert Modal -->
    <div v-if="flashMessage" class="bg-teal-100 border-t-4 border-teal-500 text-teal-900 px-6 py-4 shadow-lg rounded-lg fixed top-20 left-95 w-96"role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold">{{ flashMessage }} </p>
                        <p class="text-sm">Make sure to check your spelling before adding something.</p>
                    </div>
                </div>
            </div>

    <div class="mt-4 mx-4">
        <div class="flex justify-between mb-4">
            <h5>Product Lists</h5>
        </div>

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
    <div class="ml-auto flex space-x-2">
    <button @click="openAddModal" class="bg-blue-500 text-white rounded px-3 py-1.5 flex items-center">
        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Product
    </button>
    <button @click="openAddCategoryModal" class="bg-green-500 text-white rounded px-3 py-1.5 flex items-center">
        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Category
    </button>
</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm font-light text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4">Id</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Category</th>
                            <th scope="col" class="px-6 py-4">Price</th>
                            <th scope="col" class="px-6 py-4">Description</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in paginatedProducts" :key="item.id" class="border-b border-neutral-200 transition hover:bg-neutral-100">
                            <td class="whitespace-nowrap px-6 py-4">{{ item.id }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ item.name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ categoryMap[item.category_id] || 'Uncategorized' }}</td>
                            <td class="whitespace-nowrap px-6 py-4"><a>₱ </a>{{ item.price }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ item.description }}</td>
                            <td>
                                <button
                                    id="apple-ipad-air-dropdown-button"
                                    @click="toggleDropdown(item.id)"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover:bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button"
                                >
                                <svg
                                    class="w-5 h-5"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                </button>

                        <!-- Dropdown Menu -->
                        <div v-if="dropdownOpen === item.id" class="absolute right-0 z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm" aria-labelledby="apple-ipad-air-dropdown-button">
                                <li>
                                    <button @click="openModal('edit', item)" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                        </svg>
                                        Edit
                                    </button>
                                </li>
                                <li>
                                    <button @click="openModal('show', item)" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        Preview
                                    </button>
                                </li>
                                 <li>
                                    <button @click="openDeleteModal(item.name, item.id)" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                        <svg class="w-4 h-4 mr-2" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                        </svg>
                                        Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
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
    </div>

    <ShowModal :isOpen="showModal" :product="selectedProduct" @close="closeModal" />
    <EditModal :isOpen="editModal" :product="selectedProduct" :categories="props.categories" @close="closeModal" @save="updateProduct" />
    <AddProductModal :isOpen="addModal" :categories="props.categories" @close="closeAddModal" @add="addProduct" />
    <AddCategoryModal :isOpen="isCategoryModalOpen" @add="addCategory" @close="closeAddCategoryModal" />
    <DeleteConfirmationModal :isOpen="deleteModal" :productName="productNameToDelete" @close="closeDeleteModal" @confirm="confirmDeleteProduct" />
</DashboardLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch, computed, defineProps } from 'vue';
import ShowModal from './Show.vue';
import EditModal from './Edit.vue';
import AddProductModal from './Create.vue';
import AddCategoryModal from './AddCategoryModal.vue';
import { Inertia } from '@inertiajs/inertia';
import DeleteConfirmationModal from './DeleteConfirmationModal.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    products: Array,
    categories: Array,
    flash: Object,
});

const showModal = ref(false);
const editModal = ref(false);

const addModal = ref(false);
const deleteModal = ref(false);
const productNameToDelete = ref(''); 
const isCategoryModalOpen = ref(false);
const selectedProduct = ref(null);
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(5);
const selectedCategory = ref(''); // Empty string for "All Categories"


//add category

const openAddCategoryModal = () => {
  isCategoryModalOpen.value = true;
};

const closeAddCategoryModal = () => {
  isCategoryModalOpen.value = false;
};

const addCategory = (categoryName) => {
    console.log('Category:', categoryName); // Should log the category name
    Inertia.post(route('categories.store'), { name: categoryName }, {
        onSuccess: () => {
            closeAddCategoryModal(); // Use correct close function name
            console.log('Category added successfully');
        },
        onError: (errors) => {
            console.error('Error adding category:', errors); // Logs backend validation errors or other issues
        }
    });
};


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

// Modal management
const openModal = (type, item) => {
    selectedProduct.value = item;
    if (type === 'show') showModal.value = true;
    if (type === 'edit') editModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editModal.value = false;
    selectedProduct.value = null;
};

const openAddModal = () => {
    addModal.value = true;
};

const closeAddModal = () => {
    addModal.value = false;
};

// CRUD Operations
const deleteProduct = (productId) => {
    if (confirm('Are you sure you want to delete this product?')) {
        Inertia.delete(route('products.destroy', productId), {
            onSuccess: () => {
                console.log('Product deleted successfully');
            },
            onError: (errors) => {
                console.error('Delete failed:', errors);
            }
        });
    }
};

const updateProduct = (updatedProduct) => {
    console.log('Received Updated Product:', updatedProduct); // Check if id is present
    Inertia.put(route('products.update', updatedProduct.id), {
        name: updatedProduct.name,
        price: updatedProduct.price,
        description: updatedProduct.description,
        category_id: updatedProduct.category_id,
    }, {
        onSuccess: () => {
            console.log('Product updated successfully'); // Log success
            closeModal();
        },
        onError: (errors) => {
            console.error('Update failed:', errors); // Log errors
        }
    });
};

const addProduct = (product) => {
    console.log('Product data:', product); // Check what data is being passed
    Inertia.post(route('products.store'), {
        name: product.name,
        price: product.price,
        category_id: product.category_id, // Ensure this matches your modal's v-model
        description: product.description
    }, {
        onSuccess: () => {
            closeAddModal(); // Close the modal after a successful addition
            console.log('Product added successfully');
        },
        onError: (errors) => {
            console.error('Error adding product:', errors);
        }
    });
};


//Delete script
const openDeleteModal = (productName, productId) => {
    productNameToDelete.value = productName; // Store product name
    selectedProduct.value = productId; // Store the product ID for deletion
    deleteModal.value = true; // Open delete confirmation modal
};

const closeDeleteModal = () => {
    deleteModal.value = false; // Close delete confirmation modal
    productNameToDelete.value = ''; // Clear product name
};

const confirmDeleteProduct = () => {
    deleteProduct(selectedProduct.value); // Call the delete function
    closeDeleteModal(); // Close the modal after deletion
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

const flashMessage = ref(props.flash.message); 

const closeAlertAfterTimeout = () => {
    setTimeout(() => {
        flashMessage.value = null;
    }, 3000); // 3000ms = 3 seconds
};

// Watch for changes in the flash message prop to update the local state
watch(() => props.flash.message, (newMessage) => {
    flashMessage.value = newMessage;
    if (newMessage) {
        closeAlertAfterTimeout();
    }
});

if (flashMessage.value) {
    closeAlertAfterTimeout();
}
</script>
