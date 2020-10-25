<template>
  <div class="layout-default">
    <sidebar></sidebar>
    <main-area></main-area>
  </div>
</template>

<script>
import Sidebar from "../../components/Layout/Sidebar";
import MainArea from "./MainArea";

export default {
  name: "Default",
  props: {},
  components: {
    Sidebar, MainArea,
  }
}
</script>
