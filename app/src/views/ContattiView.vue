<script>
export default {
  name: "ContattiView"
}
</script>

<template>
  <h1 class="bg-green">Contattaci</h1>
  <br>
  <form @submit.prevent="submit">
    <v-text-field
        v-model="name.value.value"
        :counter="10"
        :error-messages="name.errorMessage.value"
        label="Nome"
    ></v-text-field>

    <v-text-field
        v-model="phone.value.value"
        :counter="10"
        :error-messages="phone.errorMessage.value"
        label="Telefono"
    ></v-text-field>

    <v-text-field
        v-model="email.value.value"
        :error-messages="email.errorMessage.value"
        label="E-mail"
    ></v-text-field>

    <v-btn
        class="me-4"
        type="submit"
    >
      Invia
    </v-btn>

    <v-btn @click="handleReset">
      Pulisci campi
    </v-btn>
  </form>
</template>


<script setup>
import { ref } from 'vue'
import { useField, useForm } from 'vee-validate'

const { handleSubmit, handleReset } = useForm({
  validationSchema: {
    name (value) {
      if (value?.length >= 2) return true

      return 'Il nome deve contenere almeno 2 caratteri.'
    },
    phone (value) {
      if (value?.length > 9 && /[0-9-]+/.test(value)) return true

      return 'Il telefono deve avere almen 9 numeri.'
    },
    email (value) {
      if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true

      return "La e-mail deve essere valida."
    },
  },
})
const name = useField('name')
const phone = useField('phone')
const email = useField('email')


const submit = handleSubmit(values => {
  alert(JSON.stringify(values, null, 2))
})
</script>

<style scoped>

</style>