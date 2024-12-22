<template>
    <div class="movies-section px-4 py-8">
      <h2 class="text-3xl font-extrabold text-white mb-8 text-center">Top 5 Film</h2>
      <div class="movies grid grid-cols-2 md:grid-cols-5 gap-8">
        <div
          v-for="(movie, index) in topMovies"
          :key="movie.id"
          class="movie-card bg-gray-900 rounded-xl shadow-lg relative group overflow-hidden"
        >
          <!-- Angka Bayangan -->
          <div
            class="rank-number absolute top-1/2 left-4 transform -translate-y-1/2 text-gray-800 text-9xl font-bold opacity-20 pointer-events-none"
          >
            {{ index + 1 }}
          </div>
          <!-- Poster -->
          <img
            :src="movie.image"
            :alt="movie.title"
            class="poster rounded-t-xl object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105"
          />
          <!-- Detail -->
          <div class="p-4 text-center bg-gray-800 rounded-b-xl">
            <h3 class="text-base font-bold text-white mb-1">{{ movie.title }}</h3>
            <p class="text-gray-400 text-sm mb-2">{{ movie.releaseDate }}</p>
            <span
              class="inline-block px-3 py-1 bg-green-500 text-white text-sm font-semibold rounded-full"
            >
              {{ movie.rating }}%
            </span>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        topMovies: [
          {
            id: 1,
            title: "Red One",
            image: "/top5/redone.jpg",
            releaseDate: "Nov 06, 2024",
            rating: 70,
          },
          {
            id: 2,
            title: "Venom: The Last Dance",
            image: "/top5/venom.jpeg",
            releaseDate: "Okt 23, 2024",
            rating: 68,
          },
          {
            id: 3,
            title: "Moana 2",
            image: "/top5/moana.jpeg",
            releaseDate: "Nov 27, 2024",
            rating: 70,
          },
          {
            id: 4,
            title: "Mufasa: The Lion King",
            image: "/top5/lion.jpg",
            releaseDate: "Des 18, 2024",
            rating: 67,
          },
          {
            id: 5,
            title: "Sonic the Hedgehog 3",
            image: "/top5/sonic.jpg",
            releaseDate: "Des 25, 2024",
            rating: 75,
          },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .movies-section {
    margin-top: 2rem;
  }
  
  .movie-card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .movie-card:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
  }
  
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
  
  .rank-number {
    z-index: 1;
    user-select: none;
  }
  
  .movie-card .p-4 {
    padding: 1rem;
    background-color: #2d3748;
  }
  
  .movie-card h3 {
    font-size: 1rem;
    color: #e2e8f0;
  }
  
  .movie-card p {
    font-size: 0.875rem;
    color: #a0aec0;
  }
  </style>
  