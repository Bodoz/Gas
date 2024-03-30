<script>
export default {
  name: "HomeView"
}

</script>

<template>
<v-layout class="main">
  <v-main>
    <v-row class="h-100 justify-center align-center text-center">
      <v-col>
        <h1 class="text-amber-lighten-5 text-h2">GasGas.it</h1>
        <p class="text-amber-lighten-5">Acquista prodotti sani e freschi a KM 0 al giusto prezzo e sostieni l'economia locale</p>
      </v-col>
    </v-row>
  </v-main>
</v-layout>

</template>

<style>
.main{
  background-image: url("@/assets/gasss.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  height: 100%;
  width: 100%;
}
</style>

