<template>
  <AuthenticatedLayout>
    <div class="container mx-auto p-5 bg-white rounded-lg shadow-md max-w-6xl">
      <h1 class="text-3xl font-bold text-center text-gray-800">
        {{ isOwner ? 'Edit Post' : post.title }}
      </h1>
      <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/3">
          <img
            :src="`/images/posts/${post.id % 13 + 1}.jpg`"
            alt="Post Image"
            class="w-full h-auto object-contain rounded-lg shadow-lg"
          />
        </div>
        <div class="md:w-2/3 mb-8">
          <div v-if="isOwner" class="text-center">
            <textarea
              v-model="post.title"
              placeholder="Edit title..."
              class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4"
              rows="2"
            ></textarea>
            <textarea
              v-model="post.content"
              placeholder="Edit content..."
              class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              rows="4"
            ></textarea>
            <button
              @click="updatePost"
              style="background-color: #442834;"
              class="mt-4 px-6 py-2 text-white rounded-lg shadow hover:bg-indigo-500 transition duration-200"
            >
              Save Changes
            </button>
            <button
              @click="deletePost"
              style="background-color: #d9534f;"
              class="mt-4 ml-2 px-6 py-2 text-white rounded-lg shadow hover:bg-red-600 transition duration-200"
            >
              Delete Post
            </button>
          </div>

          <div v-else>
            <p class="text-lg text-gray-700 leading-relaxed mb-8">
              {{ post.content }}
            </p>
          </div>

          <h3 class="text-2xl font-semibold mb-4 text-gray-800">Comments</h3>
          <div class="max-h-80 overflow-y-auto space-y-4 pr-2">
            <div v-if="post.comments.length == 0">
              <i>There are no comments for this post yet!</i>
            </div>
            <div
              v-for="comment in post.comments"
              :key="comment.id"
              class="comment bg-gray-100 rounded-lg p-4 shadow flex justify-between"
            >
              <div>
                <b>{{ comment.user_id!=null?comment.user.name:'Guest' }}</b>
                <p class="text-gray-800 mb-2">{{ comment.body }}</p>
                <small class="text-gray-500"><i>{{ new Date(comment.created_at).toLocaleDateString() }}</i></small>
              </div>
              <!-- Delete button only if the comment was made by the logged-in user -->
              <div v-if="comment.user.id === currentUserId">
                <button
                  @click="deleteComment(comment.id)"
                  class="text-red-600 hover:text-red-800 transition"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
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
              class="mt-4 px-6 py-2 text-white rounded-lg shadow hover:bg-indigo-500 transition duration-200"
            >
              Add Comment
            </button>
          </div>
        </div>
      </div>
      <div class="mt-4"> 
        <a href="/posts" class="btn btn-secondary px-6 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-200">
          Back to Posts
        </a>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
});

let isOwner=false
const currentUserId = props.user?props.user.id:-1;
if (currentUserId!=-1)
 isOwner = ref(props.post.user_id === currentUserId);

const updatePost = async () => {
  try {
    await axios.put(`/posts/${props.post.id}`, { 
      title: props.post.title, 
      content: props.post.content 
    });
    alert('Post successfully updated.');
  } catch (error) {
    console.error('Error updating post:', error);
  }
};

const deletePost = async () => {
  if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
    try {
      await axios.delete(`/posts/${props.post.id}`);
      window.location.href = '/posts'; 
      alert('Post successfully deleted.');
    } catch (error) {
      console.error('Error deleting post:', error);
      alert('There was an error deleting the post.');
    }
  }
};

const addComment = async () => {
  if (!newComment.value) {
    alert('Please write a comment before submitting.');
    return;
  }
  try {
    await axios.post(`/posts/${props.post.id}/comments`, { body: newComment.value });
    newComment.value = '';
    alert('Comment successfully added.')
  } catch (error) {
    console.error('Error adding comment:', error);
    alert('There was an error adding your comment.');
  }
};

const deleteComment = async (commentId) => {
  try {
    await axios.delete(`/comments/${commentId}`);
    //props.post.comments = props.post.comments.filter(comment => comment.id !== commentId);
  } catch (error) {
    console.error('Error deleting comment:', error);
    alert('There was an error deleting the comment.');
  }
};

const newComment = ref('');
</script>
