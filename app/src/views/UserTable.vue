<template>
  <v-table class="ma-4 mr-4 border-opacity-100 border">
    <thead>
    <tr class="text-center elevation-7" >
      <th class="border">
        id
      </th>
      <th class="border ">
        Username
      </th>
      <th class="border ">
        Password
      </th>
      <th class="border ">
        Nome
      </th>
      <th class="border">
        Cognome
      </th>
      <th class="border ">
        E-mail
      </th>
      <th class="border">
        Via
      </th>
      <th class="border">
        C.A.P.
      </th>
      <th class="border">
        Paese
      </th>
      <th class="border">
        Provincia
      </th>
      <th class="border">
        GAS associato
      </th>

      <th class="border">
        <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; flex-wrap: nowrap">
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
                  title="Nuovo Utente">
                <UserForm
                    @closed="isActive.value = false"
                ></UserForm>
              </v-card>
            </template>
          </v-dialog>
        </div>
      </th>
    </tr>
    </thead>
    <tbody>
    <tr
        v-for="user in users"
        :key="user.id"
    >
      <td>{{ user.id }}</td>
      <td>{{ user.username }}</td>
      <td>{{ user.password }}</td>
      <td>{{ user.nome }}</td>
      <td>{{ user.cognome }}</td>
      <td>{{ user.email }}</td>
      <td>{{ user.via }}</td>
      <td>{{ user.cap }}</td>
      <td>{{ user.paese }}</td>
      <td>{{ user.provincia }}</td>
      <td>{{ user.gas_nome == null ? "Non iscritto" : user.gas_nome }}</td>
      <td>

        <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; flex-wrap: nowrap">
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
                  title="Modifica User"
              >
                <UserForm
                    :user="user"
                    :action = "true"
                    @closed="isActive.value = false"
                ></UserForm>
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
              @click.stop="confirmDeleteUser(user.id)"
          ></v-btn>
        </div>
      </td>
    </tr>
    </tbody>
  </v-table>
</template>

<script>
import {mapState, mapActions} from "pinia";
import {useUsersStore} from "@/stores/users.js";
import RegisterForm from "@/components/RegisterForm.vue";
import UserForm from "@/components/UserForm.vue";
import GasForm from "@/components/GasForm.vue";

const usersStore = useUsersStore()

export default {
  components: {GasForm, UserForm, RegisterForm},
  data: () => ({
    dialog: false,
    search: '',
    emptyUser: {
      username: '',
      password: '',
      nome: '',
      cognome: '',
      via: '',
      cap: '',
      paese: '',
      provincia: '',
      id: '',
    },
    u: null,
  }),
  computed: {
    ...mapState(useUsersStore, ['users']),
  },
  methods: {
    ...mapActions(useUsersStore, ['deleteUser', 'newUser']),

    confirmDeleteUser(id) {
      (confirm("sei sicuro di voler cancellare questo utente?")) && this.deleteUser(id)
    },
  },
  mounted() {
    usersStore.fetchUsers()
  },
}
</script>