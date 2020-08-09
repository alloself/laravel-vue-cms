<template>
  <v-app id="inspire" v-if="user">
    <v-navigation-drawer v-model="drawer" app>
      <v-list dense rounded>
        <v-list-item link v-for="(item,index) in menu" :key="index" :to="{name:item.name}">
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app dark color="primary">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Панель администратора</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu v-model="userMenu" :close-on-content-click="false" offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn icon v-bind="attrs" v-on="on">
            <v-icon>mdi-account</v-icon>
          </v-btn>
        </template>
        <v-card>
          <v-list>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>{{user.email}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="logout($router)">Выйти</v-btn>
          </v-card-actions>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-main>
      <router-view :key="$route.fullPath"></router-view>
    </v-main>
  </v-app>
</template>
<script>
import { routes } from "@/router";
import { mapState, mapActions } from "vuex";
export default {
  data: () => ({
    drawer: false,
    userMenu: false
  }),
  computed: {
    ...mapState("user", ["user"]),
    menu() {
      const authRoutes = routes.find(({ name }) => name === "Auth");
      return authRoutes.children.filter(
        ({ name }) =>
          name && (name.indexOf("Create") == -1 && name.indexOf("Detail") == -1)
      );
    }
  },
  methods: {
    ...mapActions("user", ["logout"])
  }
};
</script>