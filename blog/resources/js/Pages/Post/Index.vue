<template>
    <div
      v-if="posts.length"
      :style="{
        backgroundImage: `url(/images/posts/${posts[0].id})`,
      }"
      class="min-h-screen bg-cover bg-center p-8"
    >
      <h1
        class="text-4xl font-bold mb-8 text-center"
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
      >
        LIFESTYLE
      </h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="post in paginatedPosts"
          :key="post.id"
          class="card flex shadow-lg border border-light rounded bg-white/80 h-auto"
        >
          <img
            :src="`/images/posts/${post.id}.jpg`"
            alt="Post Image"
            class="w-1/3 h-32 object-cover rounded-l-lg"
          />
          <div class="card-body w-2/3 p-4 flex flex-col justify-between">
            <div>
              <h5 class="card-title text-lg font-semibold text-gray-900">{{ post.title }}</h5>
              <p class="card-text text-gray-700 mb-4">{{ post.content }}</p>
            </div>
            <a :href="`/posts/${post.id}`" class="btn btn-primary self-start">Read More</a>
          </div>
        </div>
      </div>
      <div class="mt-8 flex justify-center">
        <button @click="prevPage" :disabled="currentPage === 1" class="btn btn-secondary mx-2">Prev</button>
        <span class="mx-2">Page {{ currentPage }} of {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages" class="btn btn-secondary mx-2">Next</button>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue';

  const props = defineProps({
    posts: {
      type: Array,
      default: () => [],
    },
  });

  const postsPerPage = 9; // Broj objava po stranici
  const currentPage = ref(1);

  const totalPages = computed(() => {
    return Math.ceil(props.posts.length / postsPerPage);
  });

  const paginatedPosts = computed(() => {
    const start = (currentPage.value - 1) * postsPerPage;
    return props.posts.slice(start, start + postsPerPage);
  });

  const prevPage = () => {
    if (currentPage.value > 1) {
      currentPage.value--;
    }
  };

  const nextPage = () => {
    if (currentPage.value < totalPages.value) {
      currentPage.value++;
    }
  };


  </script>

  <style scoped>

  .card {
    transition: transform 0.2s;
  }

  .card:hover {
    transform: scale(1.05);
  }

  .card-img-top {
    border-radius: 0.5rem 0.5rem 0 0;
  }

  .card-title {
    overflow-wrap: break-word;
  }
  </style>
