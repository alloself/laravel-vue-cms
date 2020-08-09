<template>
  <list
    @create="$router.push({ name: 'PageCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'PageDetail', params: { id } })
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
    namespace: "page"
  }),
  methods: {
    ...mapActions("page", ["getEntities"])
  },
  computed: {
    ...mapGetters("page", ["items", "total"]),
    ...mapState("page", ["loading"])
  }
};
</script>