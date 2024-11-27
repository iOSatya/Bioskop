import { defineStore } from "pinia";
import { ref } from "vue";

const useLoadingStore = defineStore("loading", () => {
  const state = ref(false);

  function startLoading() {
    state.value = true;
  }

  function endLoading() {
    state.value = false;
  }

  return {
    state, startLoading, endLoading
  }

});

export default useLoadingStore;