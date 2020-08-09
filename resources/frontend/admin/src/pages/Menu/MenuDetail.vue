<template>
  <v-container fluid :key="$route.fullPath">
    <v-card>
      <v-card-title>{{ createView ? 'Создать': `# ${$route.params.id}` }} {{ createView ? 'пункт меню' :'' }}</v-card-title>
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
            label="Приоритет"
            :value="entity.order"
            @input="(val) => entityPatch.order = val"
          ></v-text-field>
          <ui-link :value="entity.link" @input="(val) => entityPatch.link = val"></ui-link>
          <v-autocomplete
            item-value="id"
            item-text="title"
            :value="entity.parent_id"
            @change="(val) => entityPatch.parent_id = val"
            :items="menus"
            outlined
            label="Родительский пункт меню"
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
    menus: [],
  }),
  methods: {
    ...mapActions("menu", [
      "createEntity",
      "getEntity",
      "deleteEntity",
      "updateEntity",
    ]),
    async create() {
      const { id } = await this.createEntity(this.entityPatch);
      this.$router.push({ name: "MenuDetail", params: { id } });
    },
    async update() {
      const data = await this.updateEntity(this.entityPatch);
      this.entity = data;
    },
    async remove() {
      await this.deleteEntity(this.entity);
      this.$router.push({ name: `Menus` });
    },
  },
  async mounted() {
    const menus = await this.client.get("all/menu");
    this.menus = menus.data;
    if (!this.createView) {
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