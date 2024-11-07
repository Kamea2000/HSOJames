<template>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main content area with Topbar and page content -->
        <div class="flex flex-col flex-1">
            <!-- Topbar -->
            <Topbar />

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import Topbar from '@/Components/Topbar.vue';
</script>
