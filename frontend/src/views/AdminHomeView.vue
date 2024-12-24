<template>

  <div class="flex flex-col justify-center items-center">

    <div class="w-5/6">
      <h1 class="text-2xl font-semibold">Movie List</h1>
      <hr class="mt-4 mb-4" style="border-color: var(--secondary);">
      <swiper-container slides-per-view="3" space-between="10" free-mode="true" class="w-full">
        <swiper-slide v-for="movie in movieList" :key="movie.id" class="flex flex-col justify-center">
          <div class="flex flex-col h-96 mb-1 rounded-t-lg p-8" style="border: 1px solid var(--lighter);">
            <p class="font-bold text-4xl mb-4">{{ movie.title }}</p>
            <hr class="mb-4">
            <p class="font-semibold">Genre : {{ movie.genre }}</p>
            <p class="font-semibold">Jam Tayang : {{ movie.start }}.00 - {{ movie.end }}.00</p>
            <p class="font-semibold">Harga : Rp. {{ movie.price }}</p>
          </div>
          
          <div class="flex flex-row">
            <RouterLink :to="{name: 'edit-movie', params: {id: movie.id}}" class="p-4 text-center w-1/2 me-1 glow" style="border: 1px solid var(--yellow); color: var(--yellow);">Edit</RouterLink>
            <button @click="deleteMovie(movie.id)" class="p-4 text-center w-1/2 glow" style="border: 1px solid var(--red); color: var(--red);">Delete</button>
          </div>
          

        </swiper-slide>
      </swiper-container>
    </div>

  </div>
  
</template>

<script setup>

  import useLoadingStore from '@/stores/loading';
  import { onMounted, ref } from 'vue';
  import { RouterLink } from 'vue-router';

  onMounted(() => {
    getMovieList();
  });

  const loadingStore = useLoadingStore();

  const movieList = ref([]);

  async function getMovieList() {
    loadingStore.startLoading();
    try {
      const response = await fetch("http://127.0.0.1:8000/api/movies", {
        method: "GET",
        headers: {"Accept": "application/json"}
      });
      const responseData = await response.json();
      movieList.value = responseData.movies;
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  async function deleteMovie(id) {
    loadingStore.startLoading();
    const response = await fetch(`http://127.0.0.1:8000/api/movies/${id}`, {
      method: "DELETE",
      headers: {"Accept": "application/json"}
    });
    const responseData = await response.json();
    getMovieList();
    loadingStore.endLoading();
  }

</script>

<style scoped>

  .glow:hover {
    filter: brightness(1.5);
  }

</style>