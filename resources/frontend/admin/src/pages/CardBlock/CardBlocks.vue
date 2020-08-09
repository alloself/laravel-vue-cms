<template>
  <list
    @create="$router.push({ name: 'CardBlockCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'CardBlockDetail', params: { id } })
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
    namespace: "cardBlock",
  }),
  methods: {
    ...mapActions("cardBlock", ["getEntities"]),
  },
  computed: {
    ...mapGetters("cardBlock", ["items", "total"]),
    ...mapState("cardBlock", ["loading"]),
  },
};
</script>