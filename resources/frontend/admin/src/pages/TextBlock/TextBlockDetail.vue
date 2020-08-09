<template>
  <v-container fluid>
    <v-card>
      <v-card-title>{{ createView ? 'Создать': `# ${$route.params.id}` }} {{ createView ? 'блок текста' :'' }}</v-card-title>
      <v-card-text>
        <v-form>
          <v-text-field
            outlined
            label="Заголовок"
            :value="computedEntity.title"
            @input="(val) => $set(entityPatch,'title',val)"
          ></v-text-field>
          <v-textarea
            outlined
            label="Контент"
            :value="computedEntity.content"
            @input="(val) => $set(entityPatch,'content',val)"
          ></v-textarea>
          <v-text-field
            outlined
            label="Приоритет"
            :value="computedEntity.order"
            @input="(val) => $set(entityPatch,'order',val)"
          ></v-text-field>
          <v-autocomplete
            item-value="id"
            item-text="title"
            multiple
            :value="computedEntity.pages"
            @change="(val) => $set(entityPatch,'pages',val)"
            :items="pages"
            outlined
            label="Страницы"
          ></v-autocomplete>
          <ui-images
            :value="computedEntity.images"
            @input="(val) => $set(entityPatch,'images',val)"
          ></ui-images>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn @click="create" dark depressed color="primary" v-if="createView">Создать</v-btn>
        <template v-else>
          <v-btn @click="update" dark depressed color="primary">Обновить</v-btn>
          <v-btn @click="remove" dark depressed color="warning">Удалить</v-btn>
        </template>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
  data: () => ({
    entity: {},
    entityPatch: {},
    pages: [],
  }),
  methods: {
    ...mapActions("textBlock", [
      "createEntity",
      "getEntity",
      "deleteEntity",
      "updateEntity",
    ]),
    setVal(prop) {
      return (val) => {
        console.log(val);
        const value = val === undefined ? null : val;
        this.$set(this.entityPatch, prop, value);
      };
    },
    async create() {
      const { id } = await this.createEntity(this.entityPatch);
      this.$router.push({ name: "TextBlockDetail", params: { id } });
    },
    async update() {
      const data = await this.updateEntity(this.entityPatch);
      this.entity = data;
    },
    async remove() {
      await this.deleteEntity(this.entity);
      this.$router.push({ name: `TextBlocks` });
    },
  },
  async updated() {
    if (this.$route.params.id && this.entity === {}) {
      const data = await this.getEntity(this.$route.params.id);
      this.entity = data;
      this.entityPatch.id = this.$route.params.id;
    }
  },
  async mounted() {
    const { data } = await this.client.get("all/page");
    this.pages = data;
    if (this.$route.params.id) {
      const data = await this.getEntity(this.$route.params.id);
      this.entity = data;
      this.entityPatch.id = this.$route.params.id;
    }
  },
  computed: {
    ...mapState(["client"]),
    computedEntity() {
      return { ...this.entity, ...this.entityPatch };
    },
    createView() {
      return !Object.keys(this.$route.params).length;
    },
  },
};
</script>