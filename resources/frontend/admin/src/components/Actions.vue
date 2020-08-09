<template>
  <v-speed-dial
    fixed
    v-model="fab"
    bottom
    right
    class="custom-fab"
    direction="left"
    transition="slide-y-reverse-transition"
  >
    <template v-slot:activator>
      <VBtn fab v-model="fab" color="primary" dark>
        <v-icon v-if="fab">mdi-close</v-icon>
        <v-icon v-else>mdi-circle-edit-outline</v-icon>
      </VBtn>
    </template>
    <VBtn fab small @click="$emit('create')">
      <v-icon>mdi-plus</v-icon>
    </VBtn>
    <VBtn fab small :disabled="!Boolean(selected.length)" @click="$emit('delete')">
      <v-icon>mdi-delete</v-icon>
    </VBtn>
  </v-speed-dial>
</template>
<script>
export default {
  props: {
    selected: {
      type: Array,
      default: () => []
    }
  },
  data: () => ({
    fab: false
  })
};
</script>
