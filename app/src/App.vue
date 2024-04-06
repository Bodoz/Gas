<script>

import IconLogo from "@/components/icons/IconLogo.vue";

export default{
  components: {IconLogo},
  data() {
    return {
      show_login: true,
      links: [
        {to: "/", text: "Home"},
        {to: "/about", text: "About"},
        {to: "/gas", text: "Gas"},
        {to: "/contatti", text: "Contatti"},
        {to: "/accesso", text: "Accedi"},
      ],
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram',
      ],
    }
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
  </v-app>
</template>

<style scoped>

</style>
