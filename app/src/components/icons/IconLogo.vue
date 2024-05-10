<script>
import router from "@/router/index.js";
export default {
  name: "IconLogo",
  props:{
    src: String,
  },
  methods: {
    home(){
      router.push('/')
    }
  }
}
</script>

<template>
  <img :src="src">
</template>

<style>

</style>