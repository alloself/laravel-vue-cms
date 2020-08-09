<template>
  <v-container fluid>
    <v-card>
      <v-card-title>{{ createView ? 'Создать': `# ${$route.params.id}` }} {{ createView ? 'карточку' :'' }}</v-card-title>
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
          <ui-images
            multiple
            :value="computedEntity.images"
            @input="(val) => $set(entityPatch,'images',val)"
          ></ui-images>
          <ui-link :value="entity.link" @input="(val) => $set(entityPatch,'link',val)"></ui-link>
          <v-checkbox
            :value="entity.horizontal"
            @change="(val) => $set(entityPatch,'horizontal',val)"
            label="Горизонтальная"
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
  methods: {
    ...mapActions("cardBlock", [
      "createEntity",
      "getEntity",
      "deleteEntity",
      "updateEntity",
    ]),
    async create() {
      const { id } = await this.createEntity(this.entityPatch);
      this.$router.push({ name: "CardBlockDetail", params: { id } });
    },
    async update() {
      const data = await this.updateEntity(this.entityPatch);
      this.entity = data;
    },
    async remove() {
      await this.deleteEntity(this.entity);
      this.$router.push({ name: `cardBlocks` });
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