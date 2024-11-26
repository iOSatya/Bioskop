import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginView.vue'
import AdminHomeView from '@/views/AdminHomeView.vue'
import UnauthorizedView from '@/views/UnauthorizedView.vue'

// const isAdmin = localStorage.getItem("accountStatus");

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/', name: 'home', component: HomeView},
    {path: "/register", name: "register", component: RegisterView},
    {path: "/login", name: "login", component: LoginView},
    {path: "/unauthorized", name: "unauthorized", component: UnauthorizedView},

    {path: "/admin", children: [
      {path: "", name: "admin-home", component: AdminHomeView}
    ]}
  ],
})

// router.beforeEach((to, from, next) => {

//   console.log(isAdmin);
//   if (to.meta.adminAuth) {
//     if (isAdmin == "admin") {
//       next();
//     } else {
//       router.push({name: "unauthorized"});
//     }
//   } else {
//     next();
//   }

// });

export default router
