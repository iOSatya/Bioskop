import { defineStore } from "pinia";
import { ref } from "vue";

const useAuthStore = defineStore("auth", () => {
  const token = ref(localStorage.getItem("token"));
  const accountStatus = ref(localStorage.getItem("accountStatus"));

  function setToken(newToken) {
    token.value = newToken;
    if (newToken) {
      localStorage.setItem("token", newToken);
    } else {
      localStorage.removeItem("token");
    }
  }

  function setAccountStatus(newAccountStatus) {
    accountStatus.value = newAccountStatus;
    if (newAccountStatus) {
      localStorage.setItem("accountStatus", newAccountStatus);
    } else {
      localStorage.removeItem("accountStatus");
    }
  }

  return {
    token, setToken,
    accountStatus, setAccountStatus
  };
  
});

export default useAuthStore;