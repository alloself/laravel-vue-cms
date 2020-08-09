<template>
  <v-container fluid>
    <v-card>
      <v-card-title>{{ createView ? 'Создать': `# ${$route.params.id}` }} {{ createView ? 'страницу' :'' }}</v-card-title>
      <v-card-text>
        <v-form>
          <v-text-field
            outlined
            label="Заголовок"
            :value="entity.title"
            @input="(val) => entityPatch.title = val"
          ></v-text-field>
          <v-text-field
            outlined
            label="URL"
            :value="entity.path"
            @input="(val) => entityPatch.path = val"
          ></v-text-field>
          <v-text-field
            outlined
            label="Keywords"
            :value="entity.keywords"
            @input="(val) => entityPatch.keywords = val"
          ></v-text-field>
          <v-text-field
            outlined
            label="Description"
            :value="entity.description"
            @input="(val) => entityPatch.description = val"
          ></v-text-field>
          <v-autocomplete
            item-value="id"
            item-text="title"
            :value="entity.parent_id"
            @change="(val) => entityPatch.parent_id = val"
            :items="pages"
            outlined
            label="Родительская страница"
          ></v-autocomplete>
          <v-checkbox
            :value="Boolean(entity.index_page)"
            @change="(val) => entityPatch.index_page = Boolean(val)"
            label="Главная страница"
          ></v-checkbox>
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
  computed: {
    ...mapState(["client"]),
    createView() {
      return !Object.keys(this.$route.params).length;
    },
  },
  methods: {
    ...mapActions("page", [
      "createEntity",
      "getEntity",
      "deleteEntity",
      "updateEntity",
    ]),
    async create() {
      const { id } = await this.createEntity(this.entityPatch);
      this.$router.push({ name: "PageDetail", params: { id } });
    },
    async update() {
      const data = await this.updateEntity(this.entityPatch);
      this.entity = data;
    },
    async remove() {
      await this.deleteEntity(this.entity);
      this.$router.push({ name: `Pages` });
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
};
</script>