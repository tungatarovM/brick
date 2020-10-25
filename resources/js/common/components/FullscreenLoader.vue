<template>
<div class="loader loader-fullscreen__wrapper">
  <div class="loader-fullscreen__spinner-box">
    <ring-loader
      class="loader-fullscreen__spinner"
      :loading="loading"
      :color="color"
    ></ring-loader>
    <p>{{ text }}</p>
  </div>
</div>
</template>

<script>
import RingLoader from 'vue-spinner/src/RingLoader';

export default {
  name: "FullscreenLoader",
  components: {
    RingLoader,
  },
  computed: {
    text() {
      return this.dots.split().reduce((acc, dot) => {
        return acc.concat(dot);
      }, 'Загрузка');
    }
  },
  data: () => ({
    loading: true,
    color: '#9561e2',
    dots: '.',
  }),
  mounted() {
    const intervalId = setInterval(() => {
      if (this.dots.length === 3) return this.dots = '.';
      this.dots = this.dots.concat('.');
    }, 500);
  },
}
</script>

<style lang="scss">
  .loader-fullscreen {
    &__wrapper {
      align-items: center;
      background: white;
      color: black;
      display: flex;
      font-size: 24px;
      justify-content: center;
      height: 100vh;
      text-align: center;
      width: 100%;
      z-index: 2;
    }

    &__spinner {
      margin-bottom: 36px;

       .v-ring {
        margin: 0 auto;
      }
    }
  }
</style>
