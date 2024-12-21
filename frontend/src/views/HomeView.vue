<template>
  <div>
    <HeroSection />
    <TopFiveMovies />
    <NewMovies />
    <Footer />
  </div>
</template>

<script>
import HeroSection from "@/components/HeroSection.vue";
import TopFiveMovies from "@/components/TopFiveMovies.vue";
import NewMovies from "@/components/NewMovies.vue";
import Footer from "@/components/Footer.vue";

export default {
  components: {
    HeroSection,
    TopFiveMovies,
    NewMovies,
    Footer,
  },
};
</script>
