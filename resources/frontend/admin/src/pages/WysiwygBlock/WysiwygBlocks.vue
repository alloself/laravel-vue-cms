<template>
  <list
    @create="$router.push({ name: 'WysiwygBlockCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'WysiwygBlockDetail', params: { id } })
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
    namespace: "wysiwygBlock",
  }),
  methods: {
    ...mapActions("wysiwygBlock", ["getEntities"]),
  },
  computed: {
    ...mapGetters("wysiwygBlock", ["items", "total"]),
    ...mapState("wysiwygBlock", ["loading"]),
  },
};
</script>