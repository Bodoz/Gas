<script>
import IconLogo from "@/components/icons/IconLogo.vue";
import LoginForm from "@/components/LoginForm.vue"
import {mapActions, mapState, mapWritableState} from "pinia";
import {useUsersStore} from "@/stores/users.js";
import router from "@/router/index.js";

export default{
  components: {IconLogo, LoginForm},
  data() {
    return {
      links: [
        {to: "/", text: "Home"},
        {to: "/about", text: "About"},
        {to: "/gas", text: "Gas"},
        {to: "/contatti", text: "Contatti"},
      ],
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram',
      ],
    }
  },
  computed: {
    logged() {
      return this.user ? "Logout" : "Login"
    },
    welcome(){
      return this.user ? "Bentornato "+ this.user.username + " 😃" : ""
    },
    ...mapState(useUsersStore, ['user']),
    ...mapWritableState(useUsersStore, ['show_login']),
    ...mapWritableState(useUsersStore, ['isAdmin']),
  },
  methods: {
    router() {
      return router
    },
    ...mapActions(useUsersStore, ['authorized', 'authorize']),

    login() {
      if (this.user){
        this.authorize()
        this.isAdmin = false
      } else {
        this.show_login = true
      }
    },
  },
  beforeMount() {
    this.authorized() //verifica user
  }
}
</script>

<template>
  <v-app>
    <v-app-bar>
      <LoginForm></LoginForm>
      <IconLogo src="src/assets/logo.svg" @click="$router.push('/')"/>
      <v-spacer />
      <v-text
          class="mr-3 mt-4 font-weight-black"
      >{{ welcome }}</v-text>
        <v-menu
            open-on-hover
            v-if="isAdmin"
        >
        <template v-slot:activator="{ props }">
          <v-btn
              classs="mr-4"
              v-bind="props"
          >
            <span>tables</span>
          </v-btn>
        </template>

        <v-list>
            <v-list-item to="/userTab">
              <v-list-item-title>Users</v-list-item-title>
            </v-list-item>
          <v-list-item to="/gasTab">
            <v-list-item-title>Gass</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <v-tabs>

        <v-tab
            color="indigo"
            elevation="7"
            class="mx-1"
            v-for="i in links"
            :to="i.to"
        >{{ i.text }}</v-tab>
      </v-tabs>
      <v-btn
          class="mx-1"
          @click="login"
      >{{ logged }}</v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
    <v-content>
      <v-footer class="pa-0" absolute>
        <div class="bg-green d-flex w-100 align-center px-4">
          <IconLogo />
          <v-spacer></v-spacer>
          <v-btn
              v-for="icon in icons"
              :key="icon"
              :icon="icon"
              class="mx-4"
              size="small"
              variant="plain"
          ></v-btn>
        </div>
      </v-footer>
    </v-content>
  </v-app>
</template>