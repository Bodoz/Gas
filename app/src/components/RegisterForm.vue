<template>
  <div class="pa-4 text-center">
    <v-dialog
        v-model="dialog"
        max-width="600"
        persistent
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
                  v-model="username"
                  label="Username"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="password"
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
                  v-model="confirm_password"
                  label="Conferma Password"
                  :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                  :type="visible ? 'text' : 'conferma password'"
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
                  v-model="nome"
                  label="Nome"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="cognome"
                  label="Cognome"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="email"
                  label="Email"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="via"
                  label="Via"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="cap"
                  label="CAP"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="paese"
                  label="Paese"
                  required
              ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="6"
            >
              <v-text-field
                  v-model="provincia"
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
              @click="dialog=false"
          ></v-btn>

          <v-btn
              color="primary"
              text="Registrati"
              variant="tonal"
              @click="saveUser(); dialog=false"
          ></v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {mapActions, mapState, mapWritableState} from "pinia";
import {useUsersStore} from "@/stores/users.js";
export default {
  data() {
    return {
      username: "",
      password: "",
      confirm_password: "",
      nome: "",
      cognome: "",
      email: "",
      via: "",
      cap: "",
      paese: "",
      provincia: "",
      dialog: false,
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
        username: this.username,
        password: this.password,
        nome: this.nome,
        cognome: this.cognome,
        email: this.email,
        via: this.via,
        cap: this.cap,
        paese: this.paese,
        provincia: this.provincia
      }
        this.newUser(userOBJ)
    }
  },
}
</script>