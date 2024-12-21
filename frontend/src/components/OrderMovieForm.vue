<template>
  
  <div>
    <div v-for="(row, rowIndex) in movie.seats" class="flex flex-row">
      <div v-for="(column, columnIndex) in row">
        <div @click="selectSeat(rowIndex, columnIndex)" :class="{'bg-green-500': column, 'bg-red-500': !column}" class="w-8 h-8 m-1 select" style="color: var(--darker);"></div>
      </div>
    </div>
  </div>

</template>

<script setup>
  
  import useLoadingStore from '@/stores/loading';
  import { onMounted, ref } from 'vue';

  const props = defineProps({
    id: String
  });

  onMounted(() => {
    getMovieById();
  });

  const loadingStore = useLoadingStore();

  const movie = ref([]);
  const selectedSeats = [];

  async function getMovieById() {
    loadingStore.startLoading();
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/movies/${props.id}`, {
        method: "GET",
        headers: {"Accept": "application/json"}
      });
      const responseData = await response.json();
      movie.value = responseData["movie"];
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  function selectSeat(row, column) {
    console.log(row, column)
  }

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