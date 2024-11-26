import { defineStore } from "pinia";
import { ref } from "vue";

const useLoadingStore = defineStore("loading", () => {
  const state = ref(false);

  function startLoading() {
    state.value = true;
  }

  function stopLoading() {
    state.value = false;
  }

  return {
    state, startLoading, stopLoading
  }

});

export default useLoadingStore;