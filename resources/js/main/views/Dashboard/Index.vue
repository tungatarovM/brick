<template>
  <sidebar></sidebar>
  <main-area></main-area>
</template>

<script>
import Sidebar from './Sidebar';
import MainArea from './MainArea';

export default {
  name: "Index",
  components: {
    Sidebar, MainArea,
  },
  data: () => ({}),
  methods: {},
}
</script>
