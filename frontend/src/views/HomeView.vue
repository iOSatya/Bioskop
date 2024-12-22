<template>
  <div>
    <HeroSection />
    <NewMovies />
    <Footer />
  </div>
</template>

<script>
import HeroSection from "@/components/HeroSection.vue";
import NewMovies from "@/components/NewMovies.vue";
import Footer from "@/components/Footer.vue";

export default {
  components: {
    HeroSection,
    NewMovies,
    Footer,
  },
};
</script>
