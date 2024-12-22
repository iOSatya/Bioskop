<!-- src/components/MovieDetail.vue -->
<template>
    <div>
        <h1>Detail Film</h1>
        <div>
            <!-- Tampilkan detail film -->
            <p>Judul: {{ movie.title }}</p>
            <p>Rating: {{ movie.rating }}</p>
            <p>Durasi: {{ movie.duration }} menit</p>
            <p>Sinopsis: {{ movie.synopsis }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MovieDetail',
    data() {
        return {
            movie: {
                title: 'Contoh Film',
                rating: 8.5,
                duration: 120,
                synopsis: 'Ini adalah sinopsis dari contoh film.',
            },
        };
    },
};
</script>
