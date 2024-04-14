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
        @click="saveGas"
    >
      Save
    </v-btn>

    <v-btn
        class="me-4"
        @click="this.$emit('closed')"
    >Close
    </v-btn>
    </div>
  </form>
</template>

<script>
import {mapActions, mapState, mapWritableState} from "pinia";
import {useGassStore} from "@/stores/gas.js";

const gassStore = useGassStore()
export default {
  name: "GasForm",
  props: {

  },
  emits: ['closed'],
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
  computed: {
    ...mapState(useGassStore, ['gass']),
  },
  methods: {
    ...mapActions(useGassStore, ['newGas', 'updateTodo']),
    saveGas(){
      let gasOBJ = {
        nome: this.nome,
        descrizione: this.descrizione,
        via: this.via,
        civico: this.civico,
        paese: this.paese,
        provincia: this.provincia
      }
        this.newGas(gasOBJ)
        this.$emit('closed')
    }
  },
}
</script>