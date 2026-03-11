<template>
  <Welcome v-if="!isLoggedIn" />
  <router-view v-else />
</template>

<script>
import { useAuth } from './composables/useAuth';
import Welcome from './components/Welcome.vue';

export default {
  name: 'App',
  components: { Welcome },
  setup() {
    const { isLoggedIn } = useAuth();
    return { isLoggedIn };
  },
};
</script>
