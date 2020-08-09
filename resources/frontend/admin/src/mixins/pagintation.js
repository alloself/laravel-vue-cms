
import { mapActions, mapState } from 'vuex'
export default {
  methods: {
    ...mapActions('tableFilters', [
      'setTableOptions'
    ])
  },
  computed: {
    ...mapState('tableFilters', ['options']),
    moduleOptions: {
      get: function () {
        return this.options[this.namespace] || {}
      },
      set: function (value) {
        this.setTableOptions({ module: this.namespace, data: value }).then(() => {
          this.getEntities();
        });
      }
    }
  }
}