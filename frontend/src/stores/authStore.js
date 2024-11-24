import { defineStore } from "pinia";
import { ref } from "vue";

const useAuthStore = defineStore("auth", () => {
  const token = ref(localStorage.getItem("token"));

  function setToken(newToken) {
    token.value = newToken;
    if (newToken) {
      localStorage.setItem("token", newToken);
    } else {
      localStorage.removeItem("token");
    }
  }

  return {token, setToken};
});

export default useAuthStore;