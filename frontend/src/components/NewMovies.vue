<template>
    <div class="movies-section px-4 py-8">
      <h2 class="text-3xl font-extrabold text-white mb-8 text-center">Film Terbaru</h2>
      <div class="movies grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
        <div
          v-for="movie in newMovies"
          :key="movie.id"
          class="movie-card bg-gray-900 rounded-xl shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105"
        >
          <!-- Poster -->
          <img
            :src="movie.image"
            :alt="movie.title"
            class="poster rounded-t-xl object-cover w-full h-80"
          />
          <!-- Detail -->
          <div class="p-4 text-center bg-gray-800 rounded-b-xl">
            <h3 class="text-sm font-bold text-white">{{ movie.title }}</h3>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        newMovies: [
          { id: 1, title: "Atlas", image: "/movie/1.jpg" },
          { id: 2, title: "The Activated Man", image: "/movie/11.jpg" },
          { id: 3, title: "Adopted", image: "/movie/3.jpg" },
          { id: 4, title: "Afraid", image: "/movie/5.jpg" },
          { id: 5, title: "Megalopolis", image: "/movie/6.jpg" },
          { id: 6, title: "Moana 2", image: "/movie/8.jpeg" },
          { id: 7, title: "Sonic 3", image: "/movie/7.jpg" },
          { id: 8, title: "Mufasa : The Lion King", image: "/movie/9.jpg" },
          { id: 9, title: "Accidental Texan", image: "/movie/10.jpg" },
          { id: 10, title: "The Crow", image: "/movie/4.jpeg" },
        ],
      };
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
  