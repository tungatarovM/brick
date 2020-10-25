<template>
  <div class="application-root">
    <router-view></router-view>
  </div>
</template>

<script>
import Layout from './views/Layouts/Default';
import Check from "../common/mixins/Auth/Check";
import * as routes from '../core/constants/routes';

export default {
  name: "Application",
  props: {},
  components: {
    Layout,
  },
  mixins: [
    Check,
  ],
  data: () => ({
    isLoading: false,
  }),
  beforeMount() {
    this.$router.push({ name: routes.FULLSCREEN_LOADER_NAME });
    setTimeout(() => this.checkAuth(), 3000);
  }
}
</script>
