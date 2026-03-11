<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-8 px-4">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
      <header class="bg-gray-100 px-6 py-4 border-b border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-800 text-center">Countries Browser</h1>
      </header>

      <div class="p-6">
        <div v-if="store.loading" class="text-center text-gray-500 py-8">
          Loading countries…
        </div>
        <div v-else-if="store.error" class="text-center text-red-600 py-8">
          {{ store.error }}
        </div>
        <div v-else class="space-y-6">
          <RegionSelector></RegionSelector>

          <Search></Search>

          <ul class="grid grid-cols-2 gap-6">
            <CountryTile v-for="country in filteredCountries" :country="country" :key="country.name"></CountryTile>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useCountriesStore } from '../stores/countriesStore';
import RegionSelector from '@/partial/countries/RegionSelector.vue';
import Search from '@/partial/countries/Search.vue';
import CountryTile from "@/partial/countries/CountryTile.vue";

const store = useCountriesStore();

const filteredCountries = computed(() => {
  const list = store.countriesByRegion[store.selectedRegion] ?? [];
  const q = store.searchQuery.toLowerCase();
  if (!q) return list;
  return list.filter((c) => (c.name || '').toLowerCase().includes(q));
});

onMounted(() => {
  if (!store.countries.length) {
    store.getAllCountries();
  }
});

</script>
