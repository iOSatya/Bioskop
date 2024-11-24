import { defineStore } from "pinia";
import { ref } from "vue";

const useLoadingStore = defineStore("loading", () => {
  const loading = ref(false);

  function startLoading() {
    loading.value = true;
  }

  function stopLoading() {
    loading.value = false;
  }

  return {
    loading, startLoading, stopLoading
  }

});

export default useLoadingStore;