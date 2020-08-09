<template>
  <list
    @create="$router.push({ name: 'TextBlockCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'TextBlockDetail', params: { id } })
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
    namespace: "textBlock"
  }),
  methods: {
    ...mapActions("textBlock", ["getEntities"])
  },
  computed: {
    ...mapGetters("textBlock", ["items", "total"]),
    ...mapState("textBlock", ["loading"])
  }
};
</script>