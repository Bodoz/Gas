<!--<template>-->
<!--  <v-table-->
<!--      height="300px"-->
<!--      fixed-header-->
<!--  >-->
<!--    <thead>-->
<!--    <tr>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        id-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        username-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        password-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        nome-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        cognome-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        email-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        via-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        cap-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        paese-->
<!--      </th>-->
<!--      <th class="text-left elevation-7 v-color-picker" >-->
<!--        provincia-->
<!--      </th>-->
<!--      <th class="text-left elevation-7">-->
<!--        ruolo-->
<!--      </th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    <tr-->
<!--        v-for="user in users"-->
<!--        :key="user.id"-->
<!--    >-->
<!--      <td>{{ user.id }}</td>-->
<!--      <td>{{ user.username }}</td>-->
<!--      <td>{{ user.password }}</td>-->
<!--      <td>{{ user.nome }}</td>-->
<!--      <td>{{ user.cognome }}</td>-->
<!--      <td>{{ user.email }}</td>-->
<!--      <td>{{ user.via }}</td>-->
<!--      <td>{{ user.cap }}</td>-->
<!--      <td>{{ user.paese }}</td>-->
<!--      <td>{{ user.provincia }}</td>-->
<!--      <td>-->
<!--        <v-btn>modifica</v-btn>-->
<!--        <v-btn>elimina</v-btn>-->
<!--      </td>-->
<!--    </tr>-->
<!--    </tbody>-->
<!--  </v-table>-->
<!--</template>-->

<!--<script>-->
<!--import {mapState, mapActions} from "pinia";-->
<!--import {useUsersStore} from "@/stores/users.js";-->

<!--const userStore = useUsersStore()-->

<!--export default {-->
<!--  data: () => ({-->
<!--    emptyUser: {-->
<!--      nome: '',-->
<!--      descrizione: '',-->
<!--      via: '',-->
<!--      civico: '',-->
<!--      paese: '',-->
<!--      provincia: '',-->
<!--      id_gas: '',-->
<!--    },-->
<!--    g: null,-->
<!--  }),-->
<!--  computed: {-->
<!--    ...mapState(useUsersStore, ['users']),-->
<!--  },-->
<!--  methods: {-->
<!--    ...mapActions(useUsersStore, ['deleteGas', 'newGas', 'updateGas']),-->

<!--  },-->
<!--  mounted() {-->
<!--    userStore.fetchGass()-->
<!--  },-->
<!--}-->
<!--</script>-->
<template></template>
<script></script>