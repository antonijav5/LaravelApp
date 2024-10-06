<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
  <AuthenticatedLayout>
    <div class="w-1/3 mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Create a post</h2>
        <form @submit.prevent="submitPost">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input
                    type="text"
                    v-model="post.title"
                    id="title"
                    required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200"
                />
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea
                    v-model="post.content"
                    id="content"
                    required
                    rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200"
                ></textarea>
            </div>

            <button
                type="submit"
                class="w-full bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700"
            >
               Share
            </button>
        </form>
    </div>
    </AuthenticatedLayout>
</template>

<script >

export default {
    data() {
        return {
            post: {
                title: '',
                content: ''
            }
        };
    },
    methods: {
        async submitPost() {
            try {
                await axios.post('/posts', this.post);
                this.post.title = '';
                this.post.content = '';
                alert('Post successfully created!');
                this.$inertia.visit('/posts'); 
              
            } catch (error) {
              alert("An error occured while generating the post.")
            
            }
        }
    }
};
</script>
