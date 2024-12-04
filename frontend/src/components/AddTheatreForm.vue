<template>

  <div class="flex flex-row justify-evenly items-center">
    <div class="flex flex-col justify-center items-center">
      <form @submit.prevent="submitAddTheatreForm" class="flex flex-col">
        <label style="color: var(--secondary);">Theatre Name</label>
        <input v-model="theatre_name" type="text" class="form-control mb-4">
        <label style="color: var(--secondary);">Rows</label>
        <input v-model="rows" type="number" min="1" max="8" class="form-control mb-4">
        <label style="color: var(--secondary);">Column</label>
        <input v-model="columns" type="number" min="1" max="10" class="form-control mb-4">
        <button type="submit" class="button" style="border: 1px var(--lighter) solid;">Submit</button>
      </form>
    </div>
    <div class="flex w-1/2 flex-col justify-center items-center">
      <div class="flex flex-row">
        <div v-for="(columnIndex) in columns" class="flex flex-col">
          <div v-for="(rowIndex) in rows">
            <div class="w-8 h-8 bg-white m-1" style="color: var(--darker);"></div>
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
    return fetch("http://127.0.0.1:8000/api/theatres", {
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