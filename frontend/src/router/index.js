import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginView.vue'
import AdminHomeView from '@/views/AdminHomeView.vue'
import UnauthorizedView from '@/views/UnauthorizedView.vue'
import useAuthStore from '@/stores/auth'
import AddTheatreView from '@/views/AddTheatreView.vue'
import AddMovieView from '@/views/AddMovieView.vue'
import MoviesView from '@/views/MoviesView.vue'
import OrderMovieView from '@/views/OrderMovieView.vue'
import TicketsView from '@/views/TicketsView.vue'
import OrderSuccessView from '@/views/OrderSuccessView.vue'

const authStore = () => useAuthStore();

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/', name: 'home', component: HomeView},
    {path: "/movies", children: [
      {path: "", name: "movies", component: MoviesView},
      {path: "order/:id", name: "movies-order", props: true, component: OrderMovieView}
    ]},
    {path: "/tickets", name: "tickets", component: TicketsView},
    {path: "/order-success", name: "order-success", component: OrderSuccessView},

    {path: "/register", name: "register", component: RegisterView},
    {path: "/login", name: "login", component: LoginView},
    {path: "/unauthorized", name: "unauthorized", component: UnauthorizedView},

    {path: "/admin", meta: {adminAuth: true}, children: [
      {path: "home", name: "admin-home", component: AdminHomeView},
      {path: "add", name: "add", redirect: {name: "add-theatre"}, children: [
        {path: "theatre", name: "add-theatre", component: AddTheatreView},
        {path: "movie", name: "add-movie", component: AddMovieView}
      ]}
    ]}
  ],
})

router.beforeEach((to, from, next) => {

  // Cek user apakah punya otoritas untuk akses "/admin"
  if (to.meta.adminAuth) {
    if (authStore().accountStatus == "admin") {
      next();
    } else {
      next({name: "unauthorized"});
    }
  } else {
    next();
  }

});

export default router
