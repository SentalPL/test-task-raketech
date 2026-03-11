import { createRouter, createWebHistory } from 'vue-router';
import Country from '../components/Country.vue';
import Countries from "../components/Countries.vue";

const routes = [
  { path: '/', redirect: '/countries' },
  { path: '/countries', name: 'dashboard', component: Countries },
  { path: '/countries/:name', name: 'country', component: Country, props: true },
];

export const router = createRouter({
  history: createWebHistory('/'),
  routes,
});
