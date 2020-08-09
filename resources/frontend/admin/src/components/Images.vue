<template>
  <div>
    <v-autocomplete
      item-value="id"
      item-text="name"
      :value="prepearedValue"
      @input="emitValue"
      clearable
      chips
      :items="images"
      prepend-icon="mdi-plus"
      outlined
      :multiple="multiple"
      @click:prepend="createModal = true"
      label="Изображение(я)"
    >
      <template v-slot:selection="data">
        <v-chip
          @click="openModalMulti(data.item)"
          @click:close="removeItem(data.item.id)"
          close
          large
          label
          class="selectable"
        >{{ data.item.name }}</v-chip>
      </template>
    </v-autocomplete>

    <v-dialog v-model="showingFile" v-if="showingFile">
      <v-card class="modal-card-show">
        <v-card-text>
          <iframe v-if="showingFile" :src="showingFile.path"></iframe>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <a
            :href="showingFile.download"
            target="_blank"
            download
            class="v-btn v-btn--flat v-btn--text theme--light v-size--default primary--text"
          >
            <span class="v-btn__content">Скачать</span>
          </a>
          <VBtn color="primary" text @click="showingFile = null">Закрыть</VBtn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="createModal" v-if="createModal">
      <v-card class="modal-card-сreate">
        <v-card-title></v-card-title>
        <v-card-text>
          <v-form>
            <v-file-input
              label="Выберите файл"
              outlined
              :value="newImage.file"
              dense
              @change="(file) => newImage.file = file"
            ></v-file-input>
            <ui-link :value="newImage.link" @input="(val) => newImage.link = val"></ui-link>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn depressed color="primary" @click="create">Создать</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "ui-images",
  props: {
    value: {
      type: [Array, Number],
      required: true,
      default: () => [],
    },
    multiple: {
      type: Boolean,
      default: false,
    },
    change: {
      type: Function,
      default: () => undefined,
    },
  },
  data: () => ({
    images: [],
    showingFile: null,
    createModal: false,
    newImage: {},
  }),
  async created() {
    const {
      data: { data },
    } = await this.client.get("image");
    this.images = data;
  },
  methods: {
    removeItem(id) {
      if (Array.isArray(this.prepearedValue)) {
        const newValue = this.prepearedValue.filter((item) => {
          if (typeof item === "object") {
            return item.id !== id;
          } else return item !== id;
        });
        this.$emit("input", newValue);
      } else this.$emit("input", []);
    },
    emitValue(value) {
      this.$emit("input", value);
    },
    openModalMulti(file) {
      this.showingFile = file;
    },
    async create() {
      const form = new FormData();
      if (!this.newImage) return;
      form.append("image", this.newImage.file);
      if (this.newImage.link) form.append("link", this.newImage.link);
      const {
        data: { data },
      } = await this.client.post("image", form);
      this.images.push(data);
      if (!this.multiple) {
        this.$emit("input", data.id);
      } else {
        this.$emit("input", [...this.prepearedValue, data.id]);
      }
      this.createModal = false;
      this.newImage = {};
    },
  },
  computed: {
    ...mapState(["client"]),
    prepearedValue() {
      if (Array.isArray(this.value)) {
        const arrayOfIdS = this.value.map((item) => {
          if (typeof item === "object") return item.id;
          else return item;
        });
        return this.multiple ? arrayOfIdS : arrayOfIdS[0];
      } else return this.value;
    },
  },
};
</script>
<style lang="scss">
.modal-card-show {
  height: 90vh;
  overflow: hidden;
  position: relative;
  .v-card__text {
    position: relative;
    height: calc(100% - 54px);
    overflow: hidden;
    padding: 0px !important;
    margin-top: 0px;
  }
  iframe {
    width: 100%;
    height: 100%;
    border: none;
  }
}
</style>