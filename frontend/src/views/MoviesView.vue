<template>

  <div class="flex flex-col justify-center items-center">

    <div class="w-5/6">
      <h1 class="text-2xl font-semibold">Currently Airing</h1>
      <hr class="mt-4 mb-4" style="border-color: var(--secondary);">
      <swiper-container slides-per-view="3" space-between="10" free-mode="true" class="w-full">
        <swiper-slide v-for="movie in movieList" :key="movie.id" class="flex flex-col justify-center">
          <div class="flex flex-col justify-center items-center h-96 mb-2" style="border: 1px solid var(--lighter);">
            <p>{{ movie.title }}</p>
          </div>
          <div class="flex flex-row justify-start items-center p-4" style="border: 1px solid var(--yellow);">
            <p>{{ movie.start }}.00 - {{ movie.end }}.00</p>
            <RouterLink to="/movies/order" class="ms-auto">Order</RouterLink>
          </div>
        </swiper-slide>
      </swiper-container>
    </div>

  </div>
  
</template>

<script setup>

  import useLoadingStore from '@/stores/loading';
  import { onMounted, ref } from 'vue';

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

</script>