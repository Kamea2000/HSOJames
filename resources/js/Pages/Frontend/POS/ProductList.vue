<script setup>
const props = defineProps({
    products: Array,
    categories: Array,
    flash: Object,
});

</script>

<template>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm font-light text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4">Id</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Category</th>
                            <th scope="col" class="px-6 py-4">Price</th>
                            <th scope="col" class="px-6 py-4">Action</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in paginatedProducts" :key="item.id" class="border-b border-neutral-200 transition hover:bg-neutral-100">
                            <td class="whitespace-nowrap px-6 py-4">{{ item.id }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ item.name }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ categoryMap[item.category_id] || 'Uncategorized' }}</td>
                            <td class="whitespace-nowrap px-6 py-4"><a>₱ </a>{{ item.price }}</td>
                            <td class="whitespace-nowrap px-6 py-4"></td>    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</template>