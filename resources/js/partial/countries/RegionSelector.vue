<script setup>
import { computed } from 'vue';
import { useCountriesStore } from '@/stores/countriesStore.js';

const store = useCountriesStore();
const regions = computed(() => store.regions);
const selectedRegion = computed(() => store.selectedRegion);

const currentIndex = computed(() => {
  const index = regions.value.indexOf(selectedRegion.value);
  return index >= 0 ? index : 0;
});

const hasRegions = computed(() => regions.value.length > 1);

function goToPreviousRegion() {
  if (!hasRegions.value) {
    return;
  }

  const currentRegionIndex = currentIndex.value;

  const isFirstRegion = currentRegionIndex === 0;
  const nextRegionIndex = isFirstRegion ? regions.value.length - 1 : currentRegionIndex - 1;

  store.selectRegion(regions.value[nextRegionIndex]);
}

function goToNextRegion() {
  if (!hasRegions.value) {
    return;
  }

  const currentRegionIndex = currentIndex.value;

  const isLastRegion = currentRegionIndex === regions.value.length - 1;
  const nextRegionIndex = isLastRegion ? 0 : currentRegionIndex + 1;

  store.selectRegion(regions.value[nextRegionIndex]);
}
</script>

<template>
  <div class="flex items-center justify-center gap-3">
    <button
      type="button"
      :disabled="!hasRegions"
      :class="[
        'p-2 rounded-lg text-gray-700 transition-colors cursor-pointer',
        hasRegions ? 'hover:bg-gray-100' : 'opacity-40 cursor-not-allowed'
      ]"
      aria-label="Previous region"
      @click="goToPreviousRegion"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <span class="min-w-32 text-center font-medium text-gray-800">{{ selectedRegion ?? '—' }}</span>
    <button
      type="button"
      :disabled="!hasRegions"
      :class="[
        'p-2 rounded-lg text-gray-700 transition-colors cursor-pointer',
        hasRegions ? 'hover:bg-gray-100' : 'opacity-40 cursor-not-allowed'
      ]"
      aria-label="Next region"
      @click="goToNextRegion"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
</template>

<style scoped>

</style>