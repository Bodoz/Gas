<template>
  <div>
  {{ gass[0].nome }}
  </div>
</template>

<script>
import {mapState} from "pinia";
import {useGassStore} from "@/stores/gas.js";

const gassStore = useGassStore()

export default {
  data: () => ({
    emptyGas: {
      nome: '',
      descrizione: '',
      via: '',
      civico: '',
      paese: '',
      provincia: '',
      id_gas: '',
    },
    nome: null,
  }),
    computed: {
      ...mapState(useGassStore, ['gass']),
    },
    mounted() {
      gassStore.fetchGass()
    },
}
</script>