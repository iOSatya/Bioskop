<template>

  <div>
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
      <label style="color: var(--secondary);">Theatre</label>
      <div class="mb-4">
        <p @click="theatreOpen = !theatreOpen" class="form-control select">{{ theatreName || "Select" }}</p>
        <p v-for="theatre in theatreList" v-if="theatreOpen" :key="theatre.id" @click="() => {theatreOpen = !theatreOpen; theatre_id = theatre.id; theatreName = theatre.theatre_name}" class="form-control select">{{ theatre.theatre_name }}</p>
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
      <button class="button" style="border: 1px var(--lighter) solid;">Submit</button>
    </form>
  </div>

</template>

<script setup>

  import useLoadingStore from '@/stores/loading';
  import { onMounted, ref } from 'vue';

  onMounted(() => {
    getTheatreList();
  })

  const loadingStore = useLoadingStore();

  const genreOpen = ref(false);
  const theatreOpen = ref(false);
  const theatreName = ref("");

  const theatre_id = ref("");
  const title = ref("");
  const genre = ref("");
  const start = ref(6);
  const end = ref(6);

  const theatreList = ref([]);
  

  async function getTheatreList() {
    loadingStore.startLoading();
    try {
      const response = await fetch("http://127.0.0.1:8000/api/theatres", {
        method: "GET",
        headers: {"Accept": "application/json"}
      });
      const responseData = await response.json();
      theatreList.value = responseData.theatres;
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

  function grabMovieForm() {
    return JSON.stringify({
      theatre_id: theatre_id.value,
      title: title.value,
      genre: genre.value,
      start: start.value,
      end: end.value
    });
  }

  function sendMovieForm(data) {
    return fetch("http://127.0.0.1:8000/api/movies", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: data
    })
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

<style scoped>

  .select {
    cursor: pointer;
    user-select: none;
  }

  .select:hover {
    filter: brightness(2);
  }
  
</style>