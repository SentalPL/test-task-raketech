<script setup>
const { country } = defineProps(['country']);
</script>

<template>
  <li class="rounded-lg hover:bg-gray-50 transition-colors">
    <router-link
      :to="{ name: 'country', params: { name: country.name } }"
      class="flex flex-col items-center gap-2 py-3 px-2"
    >
      <span class="flag-wrapper block">
        <img
          v-if="country.flagIconUrl"
          :src="country.flagIconUrl"
          :alt="country.name"
          class="country-flag w-20 h-14 object-cover rounded shadow-sm"
        />
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
</style>