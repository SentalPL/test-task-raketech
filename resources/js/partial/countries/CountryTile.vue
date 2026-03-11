<script setup>
import { ref } from 'vue';

const { country } = defineProps(['country']);
const imageError = ref(false);

function onImageError() {
  imageError.value = true;
}
</script>

<template>
  <li class="rounded-lg hover:bg-gray-50 transition-colors">
    <router-link
      :to="{ name: 'country', params: { name: country.name } }"
      class="flex flex-col items-center gap-2 py-3 px-2"
    >
      <span class="flag-wrapper block w-20 h-14 rounded shadow-sm overflow-hidden bg-gray-100 flex items-center justify-center">
        <img
          v-if="country.flagIconUrl && !imageError"
          :src="country.flagIconUrl"
          :alt="country.name"
          class="country-flag w-full h-full object-cover"
          @error="onImageError"
        />
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          class="w-full h-full text-gray-400"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          aria-hidden="true"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6 6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
      </span>
      <span class="font-medium text-gray-800 text-center text-sm">{{ country.name }}</span>
    </router-link>
  </li>
</template>

<style scoped>
.flag-wrapper {
  display: block;
}

.country-flag {
  transition: transform 0.2s ease;
}

.flag-wrapper:hover .country-flag {
  transform: scale(1.08);
}

.flag-wrapper svg {
  flex-shrink: 0;
}
</style>