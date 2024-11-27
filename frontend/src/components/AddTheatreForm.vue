<template>

  <div class="flex flex-row w-screen h-screen justify-center items-center">
    <div class="w-full h-full flex flex-col justify-center items-center">
      <form @submit.prevent="submitAddTheatreForm" class="flex flex-col">
        <input v-model="theatre_name" type="text" placeholder="Theatre Name" class="form-control mb-4">
        <input v-model="rows" type="number" min="1" max="10" class="form-control mb-4">
        <input v-model="columns" type="number" min="1" max="10" class="form-control mb-4">
        <button type="submit" class="button" style="border: 1px var(--lighter) solid;">Submit</button>
      </form>
    </div>
    <div class="w-full h-full flex flex-col justify-center items-center">
      <div class="flex flex-row">
        <div v-for="(rowIndex) in rows" class="flex flex-col">
          <div v-for="(columnIndex) in columns">
            <div class="w-10 h-10 bg-white m-1" style="color: var(--darker);">{{ columnIndex }}-{{ rowIndex }}</div>
          </div>
        </div>
      </div>
    </div>

  </div>



</template>

<script setup>
  
  import useLoadingStore from '@/stores/loading';
  import { ref } from 'vue';

  const theatre_name = ref("");
  const rows = ref(1);
  const columns = ref(1);

  const loadingStore = useLoadingStore();

  function grabAddTheatreForm() {
    return JSON.stringify({
      theatre_name: theatre_name.value,
      rows: rows.value,
      columns: columns.value
    });
  }

  function sendAddTheatreForm(data) {
    return fetch("http://127.0.0.1:8000/api/theatre", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: data
    });
  }

  async function submitAddTheatreForm() {
    loadingStore.startLoading();
    try {
      const response = await sendAddTheatreForm(grabAddTheatreForm());
      const responseData = await response.json();
      console.log(responseData);
    } catch (error) {
      console.log(error);
    }
    loadingStore.endLoading();
  }

</script>