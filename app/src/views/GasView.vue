<template>
  <v-card>
    <v-data-iterator
        :items="gass"
        :items-per-page="3"
        :search="search"
    >
      <template v-slot:header>
        <v-toolbar class="px-2">
          <v-text-field
              v-model="search"
              density="comfortable"
              placeholder="Search"
              prepend-inner-icon="mdi-magnify"
              style="max-width: 300px;"
              variant="solo"
              clearable
              hide-details
          ></v-text-field>
        </v-toolbar>
      </template>

      <template v-slot:default="{ items : gass }">
        <v-container class="pa-2" fluid>
          <v-row dense>
            <v-col
                v-for="gas in gass"
                :key="gas.id_gas"
                cols="auto"
                md="4"
            >
              <v-card class="pb-3" border flat>
                <v-img height="225" src="src/assets/icongas.png"></v-img>

                <v-list-item :subtitle="gas.raw.descrizione" class="mb-2">
                  <template v-slot:title>
                    <strong class="text-h6 mb-2">{{ gas.raw.nome }}</strong>
                  </template>
                </v-list-item>

                <div class="d-flex justify-space-between px-4">
                  <div class="d-flex align-center text-caption text-medium-emphasis me-1">
                    <v-icon icon="mdi-map-marker" start></v-icon>

                    <div class="text-truncate">{{ gas.raw.via }}, {{gas.raw.civico}}, {{gas.raw.paese}}, {{gas.raw.provincia}}</div>
                  </div>

                </div>
                <div class="float-lg-right">
                    <v-dialog
                        v-model="dialog"
                        max-width="400"
                        persistent
                    >
                      <template v-slot:activator="{ props: activatorProps }">
                        <v-btn v-bind="activatorProps"
                            class="text-none mr-1"
                            size="small"
                            :color="(user?.id_gas === gas.raw.id_gas)? 'red': 'green'"
                            :text="(user?.id_gas === gas.raw.id_gas)? 'Disiscriviti': 'Iscriviti'"
                            border
                            flat
                            :disabled="(!user || user?.id_gas) && !(user?.id_gas === gas.raw.id_gas)"
                            @click="selectedGas = gas.raw.id_gas"
                        ></v-btn>
                      </template>

                      <v-card
                          prepend-icon="mdi-leaf-circle"
                          :title="'Vuoi ' + ((user?.id_gas === selectedGas)? 'dis': '') + 'iscriverti a questo G.A.S.?'"
                      >
                        <template v-slot:actions>
                          <v-spacer></v-spacer>

                          <v-btn
                              @click="dialog = false"
                              color="red"
                              variant="elevated"
                          >Annulla</v-btn>
                          <v-btn
                              @click="subscribe(); dialog=false"
                              color="green"
                              variant="elevated"
                          >Conferma</v-btn>
                        </template>
                      </v-card>
                    </v-dialog>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </template>

      <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
        <div class="d-flex align-center justify-center pa-4">
          <v-btn
              :disabled="page === 1"
              density="comfortable"
              icon="mdi-arrow-left"
              variant="tonal"
              rounded
              @click="prevPage"
          ></v-btn>

          <div class="mx-2 text-caption">
            Page {{ page }} of {{ pageCount }}
          </div>

          <v-btn
              :disabled="page >= pageCount"
              density="comfortable"
              icon="mdi-arrow-right"
              variant="tonal"
              rounded
              @click="nextPage"
          ></v-btn>
        </div>
      </template>
    </v-data-iterator>
    <br>
  </v-card>
</template>

<script>
import {mapState, mapActions} from "pinia";
import {useGassStore} from "@/stores/gas.js";
import GasForm from "@/components/GasForm.vue";
import {useUsersStore} from "@/stores/users.js";

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
    selectedGas: null,
  }),
  computed: {
    ...mapState(useGassStore, ['gass']),
    ...mapState(useUsersStore, ['user']),
  },
  methods: {
    ...mapActions(useGassStore, ['deleteGas', 'newGas', 'updateGas']),
    ...mapActions(useUsersStore, ['subscribeToGas']),

    subscribe(){
      if(this.user.id_gas === this.selectedGas){
        this.selectedGas = null
      }
      let body = {
        id: this.user.id,
        id_gas: this.selectedGas,
      }

      this.subscribeToGas(body)
    },
  },
  mounted() {
    gassStore.fetchGass()
  },
}

// export default {
//   data: () => ({
//     search: '',
//     gasss: [
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_h7rn8.jpg',
//         title: 'GAS LAGUNA',
//         subtitle: 'Il Gruppo nasce nel giugno 2014, è l\' unico nella nostra città ed è una realtà tra le più attive nel Veneto. È composto ad oggi da circa 80 di famiglie.',
//         advanced: false,
//         place: 'Via San Marco 1857 CHIOGGIA (VE)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_1vwqk.jpg',
//         title: 'Associazione credi GAS TOR DE CENCI',
//         subtitle: 'Siamo un gruppo di cristiani di Roma, operiamo nella Parrocchia di Gesù Divin Salvatore nel quartiere di Tor De Cenci nella periferia sud della città.',
//         advanced: false,
//         place: 'VIA BANZI 1 ROMA (RM)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_74wa3.jpg',
//         title: 'Villaggio Saggio a.p.s.',
//         subtitle: 'In un mondo che ha perso la sua dimensione uomo/natura, Villaggio Saggio vuole essere il nuovo modo con il quale possiamo ripensare società, lavoro e natura.',
//         advanced: false,
//         place: 'via dell\'arengo 77/79 OFFAGNA (AN)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_nrbhv.jpg',
//         title: "GasB gruppo d'acquisto solidale biella",
//         subtitle: 'siamo un gruppo di persone che decide di incontrarsi per riflettere sui nostri consumi e per acquistare prodotti di uso comune utilizzando come criterio guida il concetto di giustizia, solidarietà e minimizzazione dell’impatto ambientale.',
//         advanced: true,
//         place: 'via Serralunga 41 presso Cittadellarte, Fondazione Pistoletto (portone Semi Urbani) 13900, CHIAVAZZA (BI)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_yo6w7.jpg',
//         title: 'GAeS Giustizia Sociale',
//         subtitle: 'Vogliamo creare uno stretto rapporto con il territorio circostante non solo attraverso la socializzazione fra i membri ma soprattutto nel tentativo di rilanciare un legame con le tradizioni enogastronomiche e culturali dei luoghi di appartenenza.',
//         advanced: true,
//         place: 'Via Travi 84 r SESTRI PONENTE (GE)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_2xozi.jpg',
//         title: 'GRUPPO ACQUISTI SOLIDALE Economia di PROSSIMITA',
//         subtitle: 'favorisce il consumo responsabile, offrendo prodotti locali e sostenibili. Attraverso incontri regolari, promuoviamo la solidarietà e la connessione tra produttori e consumatori, contribuendo alla crescita di una comunità consapevole e impegnata.',
//         advanced: true,
//         place: 'VIA GREGORIO ASBESTA 18/6 SOLARINO (SR)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_0q3ul.jpg',
//         title: 'GAeS Riviera',
//         subtitle: 'Siamo un Gruppo di Acquisto Solidale formato da persone che condividono i valori di Etica, Ecologia, Solidarietà e Collaborazione, e che puntano ad adottare stili di vita sostenibili e consapevoli. ',
//         advanced: false,
//         place: 'Opere Parrocchiali San Giorgio - Via Don Pelle, 20 ALBENGA (SV)',
//       },
//       {
//         img: 'https://www.gastore.it/public/avatar/logogas_qxcgg.jpg',
//         title: 'Salento Express Gas',
//         subtitle: 'Vogliamo creare uno stretto rapporto con il territorio circostante non solo attraverso la socializzazione fra i membri ma soprattutto nel tentativo di rilanciare un legame con le tradizioni enogastronomiche e culturali dei luoghi di appartenenza.',
//         advanced: true,
//         place: 'piazza Jan Palach, 32 ROMA (RM)',
//       },
//     ],
//     links: [
//       {to: "/visualizzaGas", text: "visualizzaGas"},
//     ],
//   }),
//}
</script>