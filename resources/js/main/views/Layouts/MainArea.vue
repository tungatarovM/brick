<template>
  <div class="main-area__wrapper">
    <default-header></default-header>
    <router-view></router-view>
  </div>
</template>

<script>
import DefaultHeader from "../../components/Layout/DefaultHeader";

export default {
  name: "MainArea",
  props: {},
  components: {
    DefaultHeader,
  }
}
</script>

