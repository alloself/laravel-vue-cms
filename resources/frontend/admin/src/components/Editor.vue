<template>
  <div class="ui-editor">
    <ckeditor :editor="editor" :value="value" @input="(value) => $emit('input',value)"></ckeditor>
  </div>
</template>

<script >
import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  components: {
    ckeditor: CKEditor.component
  },
  props: {
    value: {
      type: String
    }
  },
  data: () => ({
    editor: ClassicEditor
  })
};
</script>

<style>
.ui-editor{
  margin-bottom: 32px;
}
</style>