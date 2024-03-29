<script>
export default {
  name: "AccessoView"
}
</script>

<template>
  <h1 class="bg-green">Accedi</h1>
  <br>
  <form @submit.prevent="submit">
    <v-text-field
        v-model="username.value.value"
        :counter="10"
        :error-messages="username.errorMessage.value"
        label="Username"
    ></v-text-field>

    <v-text-field
        v-model="password.value.value"
        :error-messages="password.errorMessage.value"
        label="Password"
    ></v-text-field>

    <v-btn
        class="me-4"
        type="submit"
    >
      Login
    </v-btn>
    <v-btn >
      Registrati
    </v-btn>
  </form>
</template>

<script setup>
import { useField, useForm } from 'vee-validate'

const { handleSubmit } = useForm({
  validationSchema: {
    name (value) {
      if (value?.length >= 2) return true

      return 'inserisci username corretto.'
    },
    email (value) {
      if (value?.length >= 2) return true

      return "inserisci username corretta."
    },
  },
})
const username = useField('username')
const password = useField('password')


const submit = handleSubmit(values => {
  alert(JSON.stringify(values, null, 2))
})
</script>

<style scoped>

</style>