<template>
  <div class="movies-section px-4 py-8">
    <h2 class="text-3xl font-extrabold text-white mb-8 text-center">5 Film Terbaru</h2>
    <div v-if="movies.length" class="movies grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
      <div
        v-for="movie in movies"
        :key="movie.id"
        class="movie-card bg-gray-900 rounded-xl shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105"
      >
        <img
          :src="'http://localhost:8000/' + movie.poster"
          :alt="movie.title"
          class="poster rounded-t-xl object-cover w-full h-80"
        />
        <div class="p-4 text-center bg-gray-800 rounded-b-xl">
          <h3 class="text-sm font-bold text-white">{{ movie.title }}</h3>
        </div>
      </div>
    </div>
    <p v-else class="text-center text-gray-400">Tidak ada film terbaru untuk ditampilkan.</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      movies: [], // Array untuk menyimpan 5 film terbaru
    };
  },
  methods: {
    async fetchLatestMovies() {
      try {
        const response = await axios.get("http://localhost:8000/api/movies/latest");
        this.movies = response.data; // Simpan data film ke variabel movies
      } catch (error) {
        console.error("Error fetching latest movies:", error);
      }
    },
  },
  created() {
    this.fetchLatestMovies(); // Panggil API saat komponen dimuat
  },
};
</script>

<style scoped>
.movies-section {
  margin-top: 2rem;
}

/* Card Styling */
.movie-card {
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.movie-card:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
}

/* Poster Styling */
.poster {
  height: 20rem; /* Tinggi poster sesuai rasio 2:3 */
  object-fit: cover;
  border-top-left-radius: 0.75rem;
  border-top-right-radius: 0.75rem;
  transition: transform 0.3s ease;
}

.movie-card:hover .poster {
  transform: scale(1.1);
}

/* Detail Section */
.movie-card .p-4 {
  padding: 1rem;
  background-color: #2d3748;
  border-bottom-left-radius: 0.75rem;
  border-bottom-right-radius: 0.75rem;
}

.movie-card h3 {
  font-size: 1rem;
  color: #e2e8f0;
  font-weight: bold;
}
</style>
