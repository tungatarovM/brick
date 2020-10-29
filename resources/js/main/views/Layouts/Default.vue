<template>
  <div class="layout-default">
    <navbar></navbar>
    <main-area></main-area>
  </div>
</template>

<script>
import Navbar from "../../components/Layout/Navbar";
import MainArea from "./MainArea";

export default {
  name: "Default",
  props: {},
  components: {
    Navbar, MainArea,
  }
}
</script>
