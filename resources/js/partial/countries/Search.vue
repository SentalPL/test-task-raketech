<script setup>
import { useCountriesStore } from '@/stores/countriesStore.js';

const store = useCountriesStore();
</script>

<template>
  <div class="w-full text-center">
    <input
      type="search"
      :value="store.searchQuery"
      placeholder="Search country"
      class="w-50 px-3 py-2 text-center rounded-lg border border-gray-200 bg-gray-50 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent"
      @input="store.setSearchQuery(($event.target).value)"
    />
  </div>
</template>
