<template>
  <list
    @create="$router.push({ name: 'CarouselBlockCreate' })"
    :headers="headers"
    :options.sync="moduleOptions"
    :loading="loading"
    :items="items"
    @click-row="
        ( id ) =>
          $router.push({ name: 'CarouselBlockDetail', params: { id } })
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
    namespace: "carouselBlock",
  }),
  methods: {
    ...mapActions("carouselBlock", ["getEntities"]),
  },
  computed: {
    ...mapGetters("carouselBlock", ["items", "total"]),
    ...mapState("carouselBlock", ["loading"]),
  },
};
</script>