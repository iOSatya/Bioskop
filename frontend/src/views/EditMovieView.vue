<template>

  <div class="flex flex-col justify-center p-12">
    <form @submit.prevent="submitMovieForm" class="flex flex-col justify-center">
      <label style="color: var(--secondary);">Title</label>
      <input v-model="title" type="text" class="form-control mb-4">

      <label style="color: var(--secondary);">Genre</label>
      <div class="mb-4">
        <p @click="genreOpen = !genreOpen" class="form-control select">{{ genre || "Select" }}</p>
        <p v-if="genreOpen" @click="() => {genreOpen = !genreOpen; genre = 'Action'}" class="form-control select">Action</p>
        <p v-if="genreOpen" @click="() => {genreOpen = !genreOpen; genre = 'Comedy'}" class="form-control select">Comedy</p>
        <p v-if="genreOpen" @click="() => {genreOpen = !genreOpen; genre = 'Horror'}" class="form-control select">Horror</p>
      </div>

      <div class="flex flex-row justify-stretch mb-4">
        <div class="flex flex-col w-1/4 me-4">
          <label style="color: var(--secondary);">Start</label>
          <input v-model="start" type="number" min="6" max="22" class="form-control">
        </div>
        <div class="flex flex-col w-1/4">
          <label style="color: var(--secondary);">End</label>
          <input v-model="end" type="number" min="6" max="22" class="form-control">
        </div>
      </div>
      <label style="color: var(--secondary);">Price</label>
      <input v-model="price" type="text" class="form-control mb-4">
      <button class="button" style="border: 1px var(--lighter) solid;">Edit</button>
    </form>
  </div>

</template>

<script setup>

  import useLoadingStore from '@/stores/loading';
  import { ref } from 'vue';
  import { onMounted } from 'vue';

  const props = defineProps({
    id: String
  });

  const loadingStore = useLoadingStore();
  const genreOpen = ref(false);

  const title = ref("");
  const genre = ref("");
  const start = ref(6);
  const end = ref(6);
  const price = ref("");

  onMounted(() => {
    getMovieById();
  });

  async function getMovieById() {
    loadingStore.startLoading();
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/movies/${props.id}`, {
        method: "GET",
        headers: {"Accept": "application/json"}
      });
      const responseData = await response.json();
      title.value = responseData["movie"]["title"];
      genre.value = responseData["movie"]["genre"];
      start.value = responseData["movie"]["start"];
      end.value = responseData["movie"]["end"];
      price.value = responseData["movie"]["price"];
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  function grabMovieForm() {
    return JSON.stringify({
      title: title.value,
      genre: genre.value,
      start: start.value,
      end: end.value,
      price: price.value
    });
  }

  function sendMovieForm(data) {
    return fetch(`http://127.0.0.1:8000/api/movies/${props.id}`, {
      method: "PATCH",
      headers: {"Content-Type": "application/json"},
      body: data
    });
  }

  async function submitMovieForm() {
    loadingStore.startLoading();
    try {
      const response = await sendMovieForm(grabMovieForm());
      const responseData = await response.json();
      console.log(responseData);
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

</script>