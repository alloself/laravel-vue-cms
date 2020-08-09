<template>
  <v-container fluid>
    <v-card>
      <v-card-title>{{ createView ? 'Создать': `# ${$route.params.id}` }} {{ createView ? 'блок текста' :'' }}</v-card-title>
      <v-card-text>
        <v-form>
          <v-text-field
            outlined
            label="Заголовок"
            :value="entity.title"
            @input="(val) => entityPatch.title = val"
          ></v-text-field>
          <editor :value="entity.content" @input="(val) => entityPatch.content = val"></editor>
          <v-text-field
            outlined
            label="Приоритет"
            :value="entity.order"
            @input="(val) => entityPatch.order = val"
          ></v-text-field>
          <v-autocomplete
            item-value="id"
            item-text="title"
            multiple
            :value="entity.pages"
            @change="(val) => entityPatch.pages = val"
            :items="pages"
            outlined
            label="Страницы"
          ></v-autocomplete>
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
    ...mapActions("wysiwygBlock", [
      "createEntity",
      "getEntity",
      "deleteEntity",
      "updateEntity",
    ]),
    async create() {
      const { id } = await this.createEntity(this.entityPatch);
      this.$router.push({ name: "WysiwygBlockDetail", params: { id } });
    },
    async update() {
      const data = await this.updateEntity(this.entityPatch);
      this.entity = data;
    },
    async remove() {
      await this.deleteEntity(this.entity);
      this.$router.push({ name: `WysiwygBlocks` });
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
    createView() {
      return !Object.keys(this.$route.params).length;
    },
  },
};
</script>