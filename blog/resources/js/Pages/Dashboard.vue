<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
  auth: Object
});
</script>

<template>
    <Head title="Welcome" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-xl font-semibold leading-tight text-gray-800">
                Choose your lifestyle. Now.
            </h1>
        </template>

        <div class="relative flex items-center justify-center mt-10">
         
            <a
                v-if="!auth.user"
                href="/login"
                class="absolute top-10 left-1/3 transform -translate-x-1/3 text-gray bg-stone-200 hover:bg-white-700 px-8 py-4 rounded-2xl shadow-2xl transition duration-300"
            >
          
               Log in to your account
            </a>
      
            <a
                href="/posts"
                class="absolute top-10 left-2/3 transform -translate-x-2/3 text-white bg-gray-800 hover:bg-gray-700 px-8 py-4 rounded-2xl shadow-2xl transition duration-300"
            >
                Check out lifestyle blogs!
            </a>
            <img
                src="/images/welcome.jpg" 
                alt="Lifestyle Blog"
                style="height: 40rem;"
                class="w-full h-96 object-cover rounded-lg shadow-lg"
            />
        
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>
</style>
