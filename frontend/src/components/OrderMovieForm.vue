<template>
  
  <form @submit.prevent="submitOrderMovie" class="flex flex-row w-screen">
    <div class="flex flex-col justify-center items-center w-1/2 p-8">
      <div v-for="(row, rowIndex) in movie.seats" class="flex flex-row">
        <div v-for="(column, columnIndex) in row">
          <div @click="selectSeat(rowIndex, columnIndex)" class="w-8 h-8 m-1 select" :class="seatColor(rowIndex, columnIndex)" style="color: var(--darker);"></div>
        </div>
      </div>
    </div>
    <div class="flex flex-col justify-center items-center w-1/2 p-24">
      <p class="font-bold text-2xl mb-4">{{ movie.title }} - Rp{{ price }}</p>
      <p class="font-bold text-2xl self-start mb-4">Total : Rp{{ total }}</p>
      <hr class="self-stretch mb-4">
      <button class="button self-stretch" style="border: 1px white solid;">Order</button>
    </div>
  </form>


</template>

<script setup>
  
  import router from '@/router';
import useAuthStore from '@/stores/auth';
  import useLoadingStore from '@/stores/loading';
  import { computed, onMounted, ref } from 'vue';

  const props = defineProps({
    id: String
  });

  onMounted(() => {
    getMovieById();
  });

  const loadingStore = useLoadingStore();

  const movie = ref([]);
  const price = ref(0);
  const ordered = ref(0);
  let orderedSeats = [];

  const authStore = useAuthStore();

  async function getMovieById() {
    loadingStore.startLoading();
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/movies/${props.id}`, {
        method: "GET",
        headers: {"Accept": "application/json"}
      });
      const responseData = await response.json();
      movie.value = responseData["movie"];
      price.value = responseData["movie"]["price"];
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  function grabOrderMovie() {
    return JSON.stringify({
      id: props.id,
      seats: movie.value.seats
    });
  }

  function sendOrderMovie(data) {
    return fetch(`http://127.0.0.1:8000/api/movies-order`, {
      method: "PUT",
      headers: {"Content-Type": "application/json"},
      body: data
    });
  }

  function grabTicket() {
    return JSON.stringify({
      movie_id: props.id,
      ordered_seats: orderedSeats
    });
  }

  function sendTicket(data) {
    return fetch(`http://127.0.0.1:8000/api/tickets-order`, {
      method: "POST",
      headers: {"Content-Type": "application/json", "Accept": "application/json", "Authorization": `Bearer ${authStore.token}`},
      body: data
    })
  }

  async function submitOrderMovie() {
    loadingStore.startLoading();
    try {
      if (ordered.value !== 0) {
        await sendOrderMovie(grabOrderMovie());
        await sendTicket(grabTicket());
        router.push({name: "order-success"});
      }
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  function selectSeat(row, column) {
    if (movie.value.seats[row][column] === "selected") {
      movie.value.seats[row][column] = true;
      ordered.value -= 1;
      orderedSeats = orderedSeats.filter(item => item !== `${row}-${column}`);
    } else if (movie.value.seats[row][column]) {
      movie.value.seats[row][column] = "selected";
      ordered.value += 1;
      orderedSeats.push(`${row}-${column}`);
    }
    console.log(orderedSeats);
  }

  const seatColor = computed(() => {
    return (row, column) => {
      const seatValue = movie.value.seats[row][column];
      if (seatValue === "selected") {
        return 'bg-yellow-500';
      } else if (!seatValue) {
        return 'bg-red-500';
      } else if (seatValue) {
        return 'bg-green-500';
      }
    }
  });

  const total = computed(() => {
    return price.value * ordered.value;
  });

</script>

<style>

  .select {
    cursor: pointer;
    user-select: none;
  }

  .select:hover {
    filter: brightness(2);
  }

</style>