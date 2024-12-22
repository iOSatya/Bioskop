<template>
    <footer class="bg-gray-800 text-gray-400 py-16">
      <div class="container mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 px-6">
        <div>
          <h4 class="text-white text-lg font-bold mb-4">Perusahaan</h4>
          <ul>
            <li><a href="#" class="hover:text-white">Tentang Bioskop Online</a></li>
            <li><a href="#" class="hover:text-white">Syarat Pengguna</a></li>
            <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-white">Masukan</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-white text-lg font-bold mb-4">Butuh bantuan?</h4>
          <ul>
            <li><a href="#" class="hover:text-white">Pusat Bantuan</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-white text-lg font-bold mb-4">Newsletter</h4>
          <p class="mb-4">Isi emailmu di bawah sini ya.</p>
          <div class="flex items-center">
            <input type="email" placeholder="Masukkan Email" class="p-2 rounded-l bg-gray-700 border border-gray-600">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-r hover:bg-blue-700">Subscribe</button>
          </div>
        </div>
        <div>
          <h4 class="text-white text-lg font-bold mb-4">Terhubung dengan Kami</h4>
          <div class="flex space-x-4">
            <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
            <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-white"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
      <!-- Description -->
      <div class="container mx-auto text-center text-sm text-gray-500 mt-8">
        <p>Ini adalah projek buatan <strong>Kelompok 5</strong>. Semua hak cipta dilindungi.</p>
      </div>
    </footer>
  </template>
  
  <style scoped>
  footer ul {
    list-style: none;
    padding: 0;
  }
  
  footer a {
    color: #e2e8f0; /* Menggunakan warna yang lebih terang */
    transition: color 0.3s ease;
  }
  
  footer a:hover {
    color: #ffffff; /* Warna hover menjadi putih */
  }
  
  footer input {
    background-color: #2d3748; /* Sesuaikan warna latar belakang input */
    border: 1px solid #4a5568; /* Warna border sesuai dengan desain */
  }
  
  footer button {
    background-color: #1d4ed8; /* Warna tombol sesuai dengan desain */
    border: none;
  }
  
  footer button:hover {
    background-color: #2563eb; /* Warna tombol saat hover */
  }
  
  footer .text-center {
    padding-top: 1rem;
  }
  </style>
  