<template>
  <div class="order-container bg-gradient-to-b from-black to-transparent min-h-screen flex flex-col items-center">
    <!-- Movie and Details Section -->
    <div class="movie-detail-card flex flex-row items-start bg-gray-800 text-white rounded-lg p-4 w-full max-w-5xl mb-8">
      <img 
        :src="'http://localhost:8000/' + movie.poster" 
        alt="Movie Poster" 
        class="w-36 h-auto rounded-lg shadow-lg mr-6"
      />
      <div class="movie-details flex-1">
        <h1 class="text-2xl font-bold">{{ movie.title }}</h1>
        <p class="mt-2 text-gray-300">{{ movie.synopsis }}</p>
        <p class="mt-4 text-sm text-gray-400">
          <strong>Category :</strong> {{ movie.category }} | <strong>Duration:</strong> {{ movie.duration }} mins
        </p>
      </div>
    </div>

    <!-- Schedule Section -->
    <div class="schedule-container w-full max-w-5xl px-4 mb-8">
      <h3 class="text-xl font-semibold text-white mb-4">Choose Schedule</h3>
      <div class="schedule-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div 
          v-for="schedule in schedules" 
          :key="schedule.id" 
          class="schedule-card flex flex-col justify-center items-center rounded-lg p-4 bg-gray-800 text-white shadow-lg"
        >
          <p class="text-lg">{{ schedule.date }} | {{ schedule.start_time }} - {{ schedule.end_time }}</p>
          <button 
            @click="selectSchedule(schedule)" 
            class="bg-yellow-500 text-white p-2 rounded mt-2 hover:bg-yellow-600"
          >
            Select
          </button>
        </div>
      </div>
    </div>

    <!-- Order Form -->
    <OrderForm v-if="selectedSchedule" :movie="movie" :schedule="selectedSchedule" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import OrderForm from '@/components/OrderMovieForm.vue';

const movie = ref({});
const schedules = ref([]);
const selectedSchedule = ref(null);

const route = useRoute();

const fetchMovieDetails = async () => {
  const movieId = route.params.id;
  const response = await fetch(`http://localhost:8000/api/movies/${movieId}`);
  const data = await response.json();
  movie.value = data.movie;
  schedules.value = data.schedules;
};

const selectSchedule = (schedule) => {
  selectedSchedule.value = schedule;
};

onMounted(fetchMovieDetails);
</script>

<style scoped>
/* General container styles */
.order-container {
  background-color: rgba(0, 0, 0, 0.8);
  padding: 2rem;
  border-radius: 8px;
}

/* Movie poster small size */
.movie-detail-card img {
  width: 150px;
  height: auto;
}

/* Buttons and grids */
.schedule-card button {
  transition: background-color 0.2s ease-in-out;
}

.seat-grid button {
  transition: background-color 0.2s ease-in-out;
}

.bg-green-500 {
  background-color: #34d399;
}

.bg-red-500 {
  background-color: #f87171;
}

.form-input {
  border: 1px solid #ddd;
  background-color: #333;
  color: white;
}
</style>
