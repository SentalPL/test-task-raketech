import { ref, readonly } from 'vue';

const isLoggedIn = ref(typeof window !== 'undefined' && !!window.__LOGGED_IN__);

export function useAuth() {
  return {
    isLoggedIn: readonly(isLoggedIn),
  };
}
