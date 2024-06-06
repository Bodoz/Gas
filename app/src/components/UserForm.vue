<template>
  <form class="pa-3" >
    <v-text-field
        v-model="username"
        color="green"
        label="Username"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="password"
        color="green"
        label="Password"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="nome"
        color="green"
        label="Nome"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="cognome"
        color="green"
        label="Cognome"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="email"
        color="green"
        label="Email"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="via"
        color="green"
        label="Via"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="cap"
        color="green"
        label="Cap"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="paese"
        color="green"
        label="Paese"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <v-text-field
        v-model="provincia"
        color="green"
        label="Provincia"
        style="min-height: 96px"
        variant="filled"
    ></v-text-field>
    <div class="d-flex justify-end">
      <v-btn
          class="me-4"
          @click="$emit('closed')"
      >Chiudi
      </v-btn>
      <v-btn
          class="me-4"
          @click="saveUser"
      >
        Salva
      </v-btn>
    </div>
  </form>
</template>

<script>
import {mapState, mapActions} from "pinia";
import {useUsersStore} from "@/stores/users.js";

const usersStore = useUsersStore()
export default {
  name: "UserForm",
  props: {
    user: Object,
    action: Boolean,
  },
  emits: ['closed'],
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
        this.$emit('closed')
      }
  },
  beforeMount() {
    if(this.action){
      this.username = this.user.username
      this.password = this.user.password
      this.nome = this.user.nome
      this.cognome = this.user.cognome
      this.email = this.user.email
      this.via = this.user.via
      this.cap = this.user.cap
      this.paese = this.user.paese
      this.provincia = this.user.provincia
    }
  }
}
</script>