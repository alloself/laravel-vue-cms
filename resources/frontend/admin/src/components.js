import Vue from "vue";
import { upperFirst, camelCase } from "lodash";

const requireComponent = require.context(
  "./components",
  true,
  /[A-Z]\w+\.(vue)$/
);
requireComponent.keys().forEach(fileName => {
  const componentConfig = requireComponent(fileName);
  const componentName = upperFirst(
    camelCase(
      fileName
        .split("/")
        .pop()
        .replace(/\.\w+$/, "")
    )
  );
  Vue.component(
    componentConfig.default.name || componentName,
    componentConfig.default || componentConfig
  );
});
