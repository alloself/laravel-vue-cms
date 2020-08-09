<template>
  <v-autocomplete
    item-value="id"
    item-text="title"
    :value="prepearedValue"
    @change="emitValue"
    :items="pages"
    outlined
    label="Страница"
  ></v-autocomplete>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "ui-link",
  props: {
    value: {
      type: [Array, Number],
      required: true,
      default: () => []
    },
  },
  data: () => ({
    pages: [],
  }),
  async created() {
    const { data } = await this.client.get("all/page");
    this.pages = data;
  },
  methods: {
    emitValue(value) {
      this.$emit("input", value);
    },
  },
  computed: {
    ...mapState(["client"]),
    prepearedValue() {
      if (Array.isArray(this.value)) {
        return this.value[0];
      } else return { id: Number(this.value) };
    },
  },
};
</script>