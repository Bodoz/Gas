<template>
  <v-table class="ma-4 mr-4 border-opacity-100 border">
    <thead>
    <tr class="text-center elevation-7" >
      <th class="border">
        id_gas
      </th>
      <th class="border ">
        nome
      </th>
      <th class="border">
        descrizione
      </th>
      <th class="border">
        via
      </th>
      <th class="border">
        civico
      </th>
      <th class="border">
        paese
      </th>
      <th class="border">
        provincia
      </th>
      <th class="border">
        Azioni
        <v-dialog max-width="500">
          <template v-slot:activator="{ props: activatorProps }">
            <v-btn
                v-bind="activatorProps"
                class="text-none ml-5"
                text="Aggiungi"
                border
                flat
                color="green"
            ></v-btn>
          </template>

          <template v-slot:default="{ isActive }">
            <v-card
                title="Nuovo Gas">
              <GasForm
                  @closed="isActive.value = false"
              ></GasForm>
            </v-card>
          </template>
        </v-dialog>
      </th>
    </tr>
    </thead>
    <tbody>
    <tr
        v-for="gas in gass"
        :key="gas.id_gas"
    >
      <td>{{ gas.id_gas }}</td>
      <td>{{ gas.nome }}</td>
      <td>{{ gas.descrizione }}</td>
      <td>{{ gas.via }}</td>
      <td>{{ gas.civico }}</td>
      <td>{{ gas.paese }}</td>
      <td>{{ gas.provincia }}</td>
      <td>
        <v-dialog max-width="500">
          <template v-slot:activator="{ props: activatorProps }">
            <v-btn
                v-bind="activatorProps"
                class="text-none mr-1"
                size="small"
                color="yellow"
                text="Modifica"
                border
                flat
            ></v-btn>
          </template>

          <template v-slot:default="{ isActive }">
            <v-card
                title="Modifica Gas"
            >
              <GasForm
                  :gas="gas"
                  :action = "true"
                  @closed="isActive.value = false"
              ></GasForm>
            </v-card>
          </template>
        </v-dialog>


        <v-btn
            class="text-none mr-1"
            size="small"
            color="red"
            text="Elimina"
            border
            flat
            @click.stop="confirmDeleteGas( gas.id_gas )"
        ></v-btn>
      </td>
    </tr>
    </tbody>
  </v-table>
</template>

<script>
import {mapState, mapActions} from "pinia";
import {useGassStore} from "@/stores/gas.js";
import GasForm from "@/components/GasForm.vue";

const gassStore = useGassStore()

export default {
  components: {GasForm},
  data: () => ({
    dialog: false,
    search: '',
    emptyGas: {
      nome: '',
      descrizione: '',
      via: '',
      civico: '',
      paese: '',
      provincia: '',
      id_gas: '',
    },
    g: null,
  }),
  computed: {
    ...mapState(useGassStore, ['gass']),
  },
  methods: {
    ...mapActions(useGassStore, ['deleteGas', 'newGas', 'updateGas']),

    confirmDeleteGas(id) {
      (confirm("sei sicuro di voler cancellare questo gas?")) && this.deleteGas(id)
    },
  },
  mounted() {
    gassStore.fetchGass()
  },
}
</script>