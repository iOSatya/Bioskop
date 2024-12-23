<template>
  <div>
    <HeroSection />
    <TopFiveMovies />
    <NewMovies />
  </div>
</template>

<script>
import HeroSection from "@/components/HeroSection.vue";
import TopFiveMovies from "@/components/TopFiveMovies.vue";
import NewMovies from "@/components/NewMovies.vue";

export default {
  components: {
    HeroSection,
    TopFiveMovies,
    NewMovies,
  },
};
</script>
