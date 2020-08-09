<template>
  <div>
    <v-data-table
      class="items-table"
      :headers="headers"
      :items="items"
      :loading="loading"
      :server-items-length="total"
      @click:row="({ id }) => $emit('click-row',id)"
      loading-text="Загрузка... Пожалуйста подождите"
      :options.sync="computedOptions"
      :footer-props="{
        'show-first-last-page': true,
        'items-per-page-options': [5, 10, 15, 30,50],
      }"
    ></v-data-table>
    <actions @create="$emit('create')"></actions>
  </div>
</template>
<script>
export default {
  props: {
    headers: {
      type: Array,
      default: () => []
    },
    items: {
      type: Array,
      default: () => []
    },
    options: {
      type: Object,
      default: () => {}
    },
    loading: {
      type: Boolean,
      required: true
    },
    total: {
      type: Number,
      default: 1
    }
  },
  computed: {
    computedOptions: {
      get: function() {
        return this.options;
      },
      set: function(value) {
        this.$emit("update:options", value);
      }
    }
  }
};
</script>