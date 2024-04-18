<template>
  <div class="pa-4 text-center">
    <v-dialog
        max-width="600"
    >
      <template v-slot:activator="{ props: activatorProps }">
        <v-btn
            class="text-none font-weight-regular"
            prepend-icon="mdi-account"
            text="Registrati"
            variant="tonal"
            v-bind="activatorProps"
        ></v-btn>
      </template>

      <v-card
          prepend-icon="mdi-account"
          title="Registrati!"
      >
        <v-card-text>
          <v-row dense>
            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Username"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Password"
                  :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                  :type="visible ? 'text' : 'password'"
                  @click:append-inner="visible = !visible"
                  type="password"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Nome"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Cognome"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Email"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Via"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="CAP"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Paese"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  label="Provincia"
                  required
              ></v-text-field>
            </v-col>
          </v-row>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
              text="Chiudi"
              variant="plain"
          ></v-btn>

          <v-btn
              color="primary"
              text="Registrati"
              variant="tonal"
              @click="saveUser"
          ></v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {mapActions, mapState, mapWritableState} from "pinia";
import {useUsersStore} from "@/stores/users.js";
import {useGassStore} from "@/stores/gas.js";
export default {
  data() {
    return {
      username: "",
      password: "",
      nome: "",
      cognome: "",
      email: "",
      via: "",
      cap: "",
      paese: "",
      provincia: ""
    }
  },
  emits: ['closed'],
  props: {
    show: Boolean,
    visible: false,
  },
  computed: {
    ...mapState(useUsersStore, ['users']),
  },
  methods: {
    ...mapActions(useUsersStore, ['newUser']),
    saveUser(){
      let userOBJ = {
        nome: this.nome,
        descrizione: this.descrizione,
        via: this.via,
        civico: this.civico,
        paese: this.paese,
        provincia: this.provincia
      }
        this.newUser(userOBJ)
    }
  },
}
</script>