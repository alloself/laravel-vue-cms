(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0aa00c5f"],{"21e3":function(t,e,n){"use strict";var a=n("5530"),o=n("2f62");e["a"]={methods:Object(a["a"])({},Object(o["b"])("tableFilters",["setTableOptions"])),computed:Object(a["a"])(Object(a["a"])({},Object(o["d"])("tableFilters",["options"])),{},{moduleOptions:{get:function(){return this.options[this.namespace]||{}},set:function(t){var e=this;this.setTableOptions({module:this.namespace,data:t}).then((function(){e.getEntities()}))}}})}},9660:function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("list",{attrs:{headers:t.headers,options:t.moduleOptions,loading:t.loading,items:t.items,total:t.total},on:{create:function(e){return t.$router.push({name:"TextBlockCreate"})},"update:options":function(e){t.moduleOptions=e},"click-row":function(e){return t.$router.push({name:"TextBlockDetail",params:{id:e}})}}})},o=[],i=n("5530"),s=n("2f62"),c=n("21e3"),l={mixins:[c["a"]],data:function(){return{headers:[{text:"Заголовок",value:"title"}],namespace:"textBlock"}},methods:Object(i["a"])({},Object(s["b"])("textBlock",["getEntities"])),computed:Object(i["a"])(Object(i["a"])({},Object(s["c"])("textBlock",["items","total"])),Object(s["d"])("textBlock",["loading"]))},u=l,r=n("2877"),p=Object(r["a"])(u,a,o,!1,null,null,null);e["default"]=p.exports}}]);
//# sourceMappingURL=chunk-0aa00c5f.57962210.js.map