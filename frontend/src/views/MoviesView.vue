<template>
  <div class="flex flex-col justify-center items-center bg-gradient-to-b from-black to-transparent min-h-screen">
    <!-- Section: Currently Airing Movies -->
    <div class="w-full px-4">
      <h1 class="text-2xl font-semibold text-white">Currently Airing</h1>
      <hr class="mt-4 mb-4" style="border-color: var(--secondary);">

      <!-- Scrollable container for movie list -->
      <div class="movie-list-container">
        <!-- Movie Card Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
          <div 
            v-for="movie in movieList" 
            :key="movie.id" 
            class="movie-card flex flex-col justify-center items-center rounded-lg p-2 bg-opacity-90 bg-gray-800">
            
            <!-- Poster Image with aspect-ratio for shape adjustment -->
            <img :src="'http://localhost:8000/' + movie.poster" :alt="movie.title" class="poster-image" />
            <p class="mt-2 text-lg font-semibold text-white">{{ movie.title }}</p>
            <p class="text-sm text-gray-400">⭐ {{ movie.rating }}</p>

            <!-- Movie Timing and Order Button -->
            <div class="flex flex-row justify-start items-center w-full mt-2">
              <p class="text-sm text-gray-400">TBA</p>
              <RouterLink 
                v-if="authStore.token" 
                :to="{name: 'movies-order', params: {id: movie.id}}" 
                class="ms-auto text-yellow-500 hover:underline">Order</RouterLink>
              <RouterLink 
                v-else 
                :to="{name: 'login'}" 
                class="ms-auto text-yellow-500 hover:underline">Login to Order</RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import useAuthStore from '@/stores/auth';
import useLoadingStore from '@/stores/loading';
import { onMounted, ref } from 'vue';

const loadingStore = useLoadingStore();
const authStore = useAuthStore();
const movieList = ref([]);

// Fetch movies that are currently airing
onMounted(() => {
  getMovieList();
});

async function getMovieList() {
  loadingStore.startLoading();
  try {
    const response = await fetch("http://127.0.0.1:8000/api/movies", {
      method: "GET",
      headers: {"Accept": "application/json"}
    });
    const responseData = await response.json();
    movieList.value = responseData.movies; // Assuming the API returns an array of movies
  } catch (error) {
    console.log(error);
  }
  loadingStore.endLoading();
}
</script>

<style scoped>
/* Hilangkan scroll horizontal */
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

/* Container utama */
.movie-list-container {
  display: flex;
  justify-content: center;
  padding: 1rem;
  margin: 0 auto;
  box-sizing: border-box;
}

/* Responsif grid */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Kolom fleksibel */
  gap: 16px;
  width: 100%;
}

/* Movie Card Styling */
.movie-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-radius: 10px;
  padding: 1rem;
  background-color: rgba(0, 0, 0, 0.8);
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: scale(1.05);
}

/* Poster Image */
.poster-image {
  aspect-ratio: 2 / 3; /* Tetap menjaga rasio 2:3 */
  width: 100%;
  height: auto;
  border-radius: 8px;
}

/* Text styling */
.text-yellow-500 {
  color: #f59e0b;
}

.text-yellow-500:hover {
  text-decoration: underline;
}

.text-white {
  color: #ffffff;
}

.text-gray-400 {
  color: #c4c4c4;
}
</style>
