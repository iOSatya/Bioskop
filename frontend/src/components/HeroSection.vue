<template>
    <div>
      <!-- Hero Section -->
      <div class="hero">
        <div class="carousel">
          <div
            class="carousel-item"
            v-for="(slide, index) in slides"
            :key="slide.id"
            :class="{ active: index === currentIndex }"
            :style="{ backgroundImage: `url(${slide.image})` }"
          >
            <div class="content">
              <h1 class="text-3xl font-bold">{{ slide.title }}</h1>
              <p class="text-base mt-4">{{ slide.description }}</p>
              <button class="mt-6 px-6 py-2"> {{ slide.buttonText }} </button>
            </div>
          </div>
          <button class="prev" @click="prevSlide">&#10094;</button>
          <button class="next" @click="nextSlide">&#10095;</button>
        </div>
      </div>
  
      <!-- Promo Section -->
      <div class="promo-section mt-10 px-4 py-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Promo Spesial Minggu Ini</h2>
        <div class="promo-items grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="promo in promos"
            :key="promo.id"
            class="promo-card"
          >
            <img :src="promo.image" :alt="promo.title" />
            <div class="p-4">
              <h3>{{ promo.title }}</h3>
              <p>{{ promo.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentIndex: 0,
        slides: [
          {
            id: 1,
            title: "Film Terbaik 2024",
            description: "Nikmati film terbaik dengan kualitas tinggi.",
            buttonText: "Tonton Sekarang",
            image: "/hero/ven.jpg",
          },
          {
            id: 2,
            title: "Film Populer Minggu Ini",
            description: "Film-film yang sedang trending di bioskop online.",
            buttonText: "Jelajahi",
            image: "/hero/mk.jpg",
          },
        ],
        promos: [
          {
            id: 1,
            title: "Diskon Spesial Akhir Tahun",
            description: "Nikmati diskon hingga 50% untuk semua film.",
            image: "/promo/PROMO6.png",
          },
          {
            id: 2,
            title: "Beli 1 Gratis 1",
            description: "Tonton bersama teman dengan promo spesial ini.",
            image: "/promo/PROMO2.png",
          },
          {
            id: 3,
            title: "Langganan Hemat",
            description: "Paket langganan sebulan hanya dengan Rp99.000.",
            image: "/promo/PROMO4.png",
          },
        ],
      };
    },
    methods: {
      prevSlide() {
        this.currentIndex =
          (this.currentIndex - 1 + this.slides.length) % this.slides.length;
      },
      nextSlide() {
        this.currentIndex = (this.currentIndex + 1) % this.slides.length;
      },
    },
  };
  </script>
  
  <style scoped>
  .hero {
    position: relative;
    height: 70vh;
    overflow: hidden;
    width: 90%; /* Kurangi lebar container */
    margin: 0 auto; /* Pusatkan container */
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
    background-color: #000;
  }
  
  .carousel {
    position: relative;
    height: 100%;
  }
  
  .carousel-item {
    position: absolute;
    top: 0;
    left: 100%;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 2rem;
    transition: left 0.5s ease-in-out;
    opacity: 0;
    z-index: 0;
    color: #f5f5f5;
  }
  
  .carousel-item.active {
    left: 0;
    opacity: 1;
    z-index: 1;
  }
  
  .content h1 {
    color: #ffffff;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
  }
  
  .content p {
    color: #d1d5db;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
  }
  
  button {
    background-color: #1d4ed8;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button:hover {
    background-color: #2563eb;
  }
  
  .prev,
  .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #ffffff;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    padding: 0.5rem 1rem;
    z-index: 2;
  }
  
  .prev {
    left: 10px; /* Tombol prev berada di kiri */
  }
  
  .next {
    right: 10px; /* Tombol next berada di kanan */
  }
  
  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }
  
  .promo-section {
  background-color: #1a202c;
  border-radius: 0.5rem;
  padding: 1.5rem; /* Tambahkan sedikit padding */
  color: #e2e8f0;
}

.promo-items {
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Lebar minimum lebih besar */
  gap: 1.5rem; /* Tambahkan jarak antar item */
}

.promo-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  padding: 0.75rem; /* Tambahkan sedikit padding */
  background-color: #2d3748;
  border-radius: 0.5rem;
  overflow: hidden;
}

.promo-card img {
  width: 100%;
  height: 150px; /* Tinggi gambar yang proporsional */
  object-fit: cover; /* Gambar akan menyesuaikan tanpa terdistorsi */
  border-bottom: 2px solid #4a5568;
}

.promo-card h3 {
  font-size: 1rem; /* Ukuran font standar */
  margin-top: 0.5rem;
  margin-bottom: 0.25rem;
  color: #ffffff;
}

.promo-card p {
  font-size: 0.875rem; /* Ukuran font standar */
  color: #a0aec0;
}

.promo-card:hover {
  transform: scale(1.03); /* Tambahkan sedikit efek zoom */
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
}

  </style>
  