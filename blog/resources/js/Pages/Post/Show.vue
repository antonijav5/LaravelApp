<template>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md max-w-6xl">
      <!-- Naslov posta -->
      <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">{{ post.title }}</h1>

      <!-- Flex container za sliku i sadržaj -->
      <div class="flex flex-col md:flex-row gap-8">
        <!-- Leva kolona (Slika) -->
        <div class="md:w-1/3">
          <img
            :src="`/images/posts/${post.id}.jpg`"
            alt="Post Image"
            class="w-full h-auto object-contain rounded-lg shadow-lg"
          />
        </div>

        <!-- Desna kolona (Tekst i komentari) -->
        <div class="md:w-2/3">
          <!-- Sadržaj posta -->
          <p class="text-lg text-gray-700 leading-relaxed mb-8">
            {{ post.content }}
          </p>

          <!-- Komentari -->
          <h3 class="text-2xl font-semibold mb-4 text-gray-800">Comments</h3>

          <!-- Scrollable comments section -->
          <div class="max-h-80 overflow-y-auto space-y-4 pr-2">
            <div
              v-for="comment in post.comments"
              :key="comment.id"
              class="comment bg-gray-100 rounded-lg p-4 shadow"
            >
           <b>{{ comment.user.name }}</b>
              <p class="text-gray-800 mb-2">{{ comment.body }}</p>
              <small class="text-gray-500"><i>{{ new Date(comment.created_at).toLocaleDateString() }}</i></small>
            </div>
          </div>

          <!-- Polje za unos novog komentara -->
          <div class="mt-6 text-center">
            <textarea
              v-model="newComment"
              placeholder="Write a comment..."
              class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              rows="4"
            ></textarea>
            <button
              @click="addComment"
              style="background-color: #442834;"
              class="mt-4 px-6 py-2  text-white rounded-lg shadow hover:bg-indigo-500 transition duration-200"
            >
              Add Comment
            </button>
          </div>
        </div>
      </div>

      <!-- Dugme za povratak -->
      <div class="mt-8">
        <a href="/posts" class="btn btn-secondary px-6 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-200">
          Back to Posts
        </a>
      </div>
    </div>
  </template>

  <script setup>
  defineProps({
    post: {
      type: Object,
      required: true,
    },
  });
  </script>

  <style scoped>
  /* Stilovi za scrollbar */
  .max-h-80::-webkit-scrollbar {
    width: 8px;

  }
  .max-h-80::-webkit-scrollbar-thumb {
    background-color: rgba(107, 114, 128, 0.6); /* Tailwind's Gray 600 */
    border-radius: 8px;
  }
  .max-h-80::-webkit-scrollbar-thumb:hover {
    background-color: rgba(107, 114, 128, 0.9); /* Darker on hover */
  }
  .max-h-80::-webkit-scrollbar-track {
    background-color: rgba(229, 231, 235, 0.4); /* Tailwind's Gray 200 */
  }
  </style>
