<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-8 px-4">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
      <header class="bg-gray-100 px-6 py-4 border-b border-gray-200 flex flex-col items-center gap-4">
        <router-link
          to="/countries"
          class="text-gray-600 hover:text-gray-800 font-medium"
        >
          ← Back
        </router-link>
        <h1 class="text-2xl font-semibold text-gray-800 font-sans">Countries Browser</h1>
      </header>

      <div class="p-6">
        <div v-if="store.loading && !store.selectedCountry" class="text-center text-gray-500 py-8">
          Loading…
        </div>
        <div v-else-if="store.error && !store.selectedCountry" class="text-center text-red-600 py-8">
          {{ store.error }}
        </div>
        <div v-else-if="store.selectedCountry" class="space-y-6">
          <div class="flex items-center gap-4">
            <img
              v-if="country.flagIconUrl"
              :src="country.flagIconUrl"
              :alt="country.name"
              class="w-24 h-16 object-cover rounded shadow"
            />
            <h2 class="text-2xl font-semibold text-gray-800">{{ country.name }}</h2>
          </div>

          <dl class="grid gap-3 text-sm">
            <div class="flex justify-between py-2 border-b border-gray-100">
              <dt class="font-medium text-gray-500">Region</dt>
              <dd class="text-gray-800">{{ country.region ?? '—' }}</dd>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
              <dt class="font-medium text-gray-500">Capital</dt>
              <dd class="text-gray-800">{{ country.capital ?? '—' }}</dd>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
              <dt class="font-medium text-gray-500">Language</dt>
              <dd class="text-gray-800">{{ country.language ?? '—' }}</dd>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
              <dt class="font-medium text-gray-500">Currency</dt>
              <dd class="text-gray-800">{{ country.currency ?? '—' }}</dd>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
              <dt class="font-medium text-gray-500">Population</dt>
              <dd class="text-gray-800">{{ country.population != null ? country.population.toLocaleString() : '—' }}</dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useCountriesStore } from '../stores/countriesStore';

const props = defineProps({
  name: { type: String, required: true },
});

const route = useRoute();
const store = useCountriesStore();
const country = computed(() => store.selectedCountry);

function loadCountry() {
  const name = props.name || route.params.name;
  if (name) store.getCountryDetails(name);
}

watch(() => props.name, loadCountry, { immediate: true });
watch(() => route.params.name, loadCountry);
</script>
