<template>
  <list
    @create="$router.push({ name: 'MenuCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'MenuDetail', params: { id } })
      "
    :total="total"
  ></list>
</template>
<script>
import { mapActions, mapGetters, mapState } from "vuex";
import paginationMixin from "@/mixins/pagintation";
export default {
  mixins: [paginationMixin],
  data: () => ({
    headers: [{ text: "Заголовок", value: "title" }],
    namespace: "menu",
  }),
  methods: {
    ...mapActions("menu", ["getEntities"]),
  },
  computed: {
    ...mapGetters("menu", ["items", "total"]),
    ...mapState("menu", ["loading"]),
  },
};
</script>