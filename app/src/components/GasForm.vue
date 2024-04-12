<template>
  <form class="pa-3" >
    <v-text-field
        v-model="nome"
        color="green"
        label="Nome"
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
        v-model="civico"
        color="green"
        label="Civico"
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
    <v-textarea
        v-model="descrizione"
        color="green"
        label="Descrizione"
        variant="filled"
        auto-grow
    ></v-textarea>
    <div class="d-flex justify-end">
    <v-btn
        class="me-4"
        type="submit"
    >
      submit
    </v-btn>

    <v-btn>
      clear
    </v-btn>
    </div>
  </form>
</template>

<script>
export default {
  name: "GasForm",
  data() {
    return {
      nome: "",
      descrizione: "",
      via: "",
      civico: "",
      paese: "",
      provincia: ""
    }
  },
}
</script>