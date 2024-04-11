<script>
import IconLogo from "@/components/icons/IconLogo.vue";
import LoginForm from "@/components/LoginForm.vue"
import {mapActions, mapState, mapWritableState} from "pinia";
import {useUsersStore} from "@/stores/users.js";

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
    ...mapState(useUsersStore, ['user']),
    ...mapWritableState(useUsersStore, ['show_login']),
  },
  methods: {
    ...mapActions(useUsersStore, ['authorized', 'authorize']),

    login() {
      if (this.user){
        this.authorize()
      } else {
        this.show_login = true
      }
    },
  },
  beforeMount() {
    this.authorized()
  }
}
</script>

<template>
  <v-app>
    <v-app-bar>
      <IconLogo />
      <v-spacer />
      <v-tabs >
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
      <v-footer absolute>
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
    <LoginForm></LoginForm>
  </v-app>
</template>

<style scoped>

</style>
