import { defineStore } from 'pinia';
import axios from 'axios';

export const useCountriesStore = defineStore('countries', {
  state: () => ({
    countries: [],
    countriesDetails: {},
    selectedCountry: null,
    selectedRegion: null,
    searchQuery: '',
    loading: false,
    error: null,
  }),

  getters: {
    countriesByRegion(state) {
      const countriesByRehion = {};

      for (const country of state.countries) {
        const region = country.region || 'Other';

        if (!countriesByRehion[region]) {
          countriesByRehion[region] = [];
        }

        countriesByRehion[region].push(country);
      }

      for (const region of Object.keys(countriesByRehion)) {
        countriesByRehion[region].sort((a, b) => (a.name || '').localeCompare(b.name || ''));
      }

      const sorted = Object.entries(countriesByRehion).sort(([a], [b]) => a.localeCompare(b));
      return Object.fromEntries(sorted);
    },

    regions() {
      return Object.keys(this.countriesByRegion).sort();
    },
  },

  actions: {
    selectRegion(regionName) {
      const list = this.countriesByRegion[regionName];
      if (!list?.length && this.regions.length) {
        this.selectedRegion = this.regions[0];
        return;
      }
      this.selectedRegion = regionName;
    },

    setSearchQuery(query) {
      this.searchQuery = (query || '').trim();
    },

    async getAllCountries() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await axios.get('/api/countries');
        this.countries = Array.isArray(data) ? data : [];

        if (this.regions.length) {
          this.selectRegion(this.regions[0]);
        }
      } catch (e) {
        this.error = e.response?.data?.error ?? 'Failed to load countries';
        this.countries = [];
        throw e;
      } finally {
        this.loading = false;
      }
    },

    async getCountryDetails(countryName) {
      const cachedCountry = this.countriesDetails[countryName] || null;

      if (cachedCountry) {
        this.selectedCountry = cachedCountry;
        return cachedCountry;
      }

      this.loading = true;
      this.error = null;
      this.selectedCountry = null;

      try {
        const { data } = await axios.get(`/api/countries/${encodeURIComponent(countryName)}`);

        if (this.loading) {
          this.selectedCountry = data;
          this.countriesDetails[countryName] = data;
        }

        return data;

      } catch (e) {
        this.error = e.response?.data?.error ?? 'Failed to load country details';
        this.selectedCountry = null;
        throw e;
      } finally {
        this.loading = false;
      }
    },
  },
});
