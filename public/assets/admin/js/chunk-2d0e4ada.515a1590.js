(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0e4ada"],{"90f3":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-container",{attrs:{fluid:""}},[n("v-card",[n("v-card-title",[t._v(t._s(t.createView?"Создать":"# "+t.$route.params.id)+" "+t._s(t.createView?"блок текста":""))]),n("v-card-text",[n("v-form",[n("v-text-field",{attrs:{outlined:"",label:"Заголовок",value:t.entity.title},on:{input:function(e){return t.entityPatch.title=e}}}),n("editor",{attrs:{value:t.entity.content},on:{input:function(e){return t.entityPatch.content=e}}}),n("v-text-field",{attrs:{outlined:"",label:"Приоритет",value:t.entity.order},on:{input:function(e){return t.entityPatch.order=e}}}),n("v-autocomplete",{attrs:{"item-value":"id","item-text":"title",multiple:"",value:t.entity.pages,items:t.pages,outlined:"",label:"Страницы"},on:{change:function(e){return t.entityPatch.pages=e}}})],1)],1),n("v-card-actions",[n("v-spacer"),t.createView?n("v-btn",{attrs:{dark:"",depressed:"",color:"primary"},on:{click:t.create}},[t._v("Создать")]):[n("v-btn",{attrs:{dark:"",depressed:"",color:"primary"},on:{click:t.update}},[t._v("Обновить")]),n("v-btn",{attrs:{dark:"",depressed:"",color:"warning"},on:{click:t.remove}},[t._v("Удалить")])]],2)],1)],1)},a=[],i=(n("b64b"),n("96cf"),n("1da1")),c=n("5530"),u=n("2f62"),s={data:function(){return{entity:{},entityPatch:{},pages:[]}},methods:Object(c["a"])(Object(c["a"])({},Object(u["b"])("wysiwygBlock",["createEntity","getEntity","deleteEntity","updateEntity"])),{},{create:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var n,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.createEntity(t.entityPatch);case 2:n=e.sent,r=n.id,t.$router.push({name:"WysiwygBlockDetail",params:{id:r}});case 5:case"end":return e.stop()}}),e)})))()},update:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.updateEntity(t.entityPatch);case 2:n=e.sent,t.entity=n;case 4:case"end":return e.stop()}}),e)})))()},remove:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.deleteEntity(t.entity);case 2:t.$router.push({name:"WysiwygBlocks"});case 3:case"end":return e.stop()}}),e)})))()}}),updated:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!t.$route.params.id||t.entity!=={}){e.next=6;break}return e.next=3,t.getEntity(t.$route.params.id);case 3:n=e.sent,t.entity=n,t.entityPatch.id=t.$route.params.id;case 6:case"end":return e.stop()}}),e)})))()},mounted:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var n,r,a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.client.get("all/page");case 2:if(n=e.sent,r=n.data,t.pages=r,!t.$route.params.id){e.next=11;break}return e.next=8,t.getEntity(t.$route.params.id);case 8:a=e.sent,t.entity=a,t.entityPatch.id=t.$route.params.id;case 11:case"end":return e.stop()}}),e)})))()},computed:Object(c["a"])(Object(c["a"])({},Object(u["d"])(["client"])),{},{createView:function(){return!Object.keys(this.$route.params).length}})},o=s,d=n("2877"),l=Object(d["a"])(o,r,a,!1,null,null,null);e["default"]=l.exports}}]);
//# sourceMappingURL=chunk-2d0e4ada.515a1590.js.map